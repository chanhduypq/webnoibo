<?php

class PlaynewsController extends Controller {

    public $pageTitle;
    private $_news = null;

    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_NEWS;
        if (Yii::app()->request->cookies['id'] == NULL) {
            $this->redirect(array('newgin/'));
        }
    }

    /**
     * display list news
     */
    public function actionIndex() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];       
            if(strpos($key, 'news') !== FALSE&&strpos($key, 'news_cv') == FALSE){
                if(substr($key, 0, 4) == 'file'){
                    if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                        unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                    }
                }
                unset(Yii::app()->request->cookies[$key]);                
            }           
        }

        
        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = 'id,title,content,created_date';
        $criteria->condition = (FunctionCommon::isPostFunction("news") && !FunctionCommon::isViewFunction("news")) ? "contributor_id=" .Yii::app()->request->cookies['id']->value : "true";
        $criteria->order = 'created_date DESC';

        $item_count = News::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = News::model()->findAll($criteria);
        
        $this->render('/play/news/index', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }
    public function actionUnread() {

        
        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = 'id,title,content,created_date';        
        $criteria->condition = ((FunctionCommon::isPostFunction("news") && !FunctionCommon::isViewFunction("news")) ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true")." and id not in (select news_id from news_read where user_id=".Yii::app()->request->cookies['id']->value.")";
        $criteria->order = 'created_date DESC';

        $item_count = News::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = News::model()->findAll($criteria);

        $this->render('/play/news/unread', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    /**
     * Regist 
     */
    public function actionRegist() {
        $parmas = array();
        $model = $this->loadModel();
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);            
            Yii::app()->end();
        }
        $attachment1_error = isset(Yii::app()->session['attachment1']) ? Yii::app()->params['attachment1_error'] : '';
        $attachment2_error = isset(Yii::app()->session['attachment2']) ? Yii::app()->params['attachment2_error'] : '';
        $attachment3_error = isset(Yii::app()->session['attachment3']) ? Yii::app()->params['attachment3_error'] : '';
        unset(Yii::app()->session['attachment1']);
        unset(Yii::app()->session['attachment2']);
        unset(Yii::app()->session['attachment3']);
        $parmas['model'] = $model;
        $parmas['attachment1_error'] = $attachment1_error;
        $parmas['attachment2_error'] = $attachment2_error;
        $parmas['attachment3_error'] = $attachment3_error;
        $this->render('/play/news/regist', $parmas);
    }

    /**
     * Regist confirm
     */
    public function actionRegistconfirm() {
        $model = $this->loadModel();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['regist']) || $_POST['regist'] != '1') {
                Upload_file_common_new::processAttachments($model, 'news', 1);
            }
            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    $model->attachment1 = $_POST['News']['attachment1'];
                    $model->attachment2 = $_POST['News']['attachment2'];
                    $model->attachment3 = $_POST['News']['attachment3'];
                    if ($model->save() == true) {
                        if (FunctionCommon::isViewFunction("news") == false) {
                            $this->redirect(array('play/'));
                        } else {
                            $this->redirect(array('playnews/index'));
                        }
                    }
                }
            } else {
                if ($model->getError("attachment1") != "") {
                    Yii::app()->session['attachment1'] = true;
                }

                if ($model->getError("attachment2") != "") {
                    Yii::app()->session['attachment2'] = true;
                }

                if ($model->getError("attachment3") != "") {
                    Yii::app()->session['attachment3'] = true;
                }
                /**
                 * 
                 */
                if ($model->attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment1)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->attachment1);
                }
                if ($model->attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment2)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->attachment2);
                }
                if ($model->attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment3)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->attachment3);
                }
                $cookie_collection = Yii::app()->request->cookies;
                $key_array = $cookie_collection->getKeys();
                for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                    $key = $key_array[$i];
                    if (substr($key, 0, 4) == 'file') {
                        if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                            unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                        }
                        unset(Yii::app()->request->cookies[$key]);
                    }
                }
                $this->redirect(array('playnews/regist'));
            }
        } else {
            $this->redirect(array('playnews/index'));
        }
        $this->render('/play/news/registconfirm', array('model' => $model));
    }

    public function actionDetail() {

        $model = $this->loadModel();



        if (!empty($model->title)) {
            $count = Yii::app()->db->createCommand()
                    ->select("count(*) as count")
                    ->from("news_read")
                    ->where("user_id=" . Yii::app()->request->cookies['id']->value . " and news_id=" . $model->id)
                    ->queryScalar();
            if ($count == '0') {
                Yii::app()->db->createCommand("insert into news_read values (" . $model->id . "," . Yii::app()->request->cookies['id']->value . ")")->execute();
            }


            $this->render('/play/news/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/playnews/index'));
        }
    }
    public function actionDetail_unread() {

        $model = $this->loadModel();



        if (!empty($model->title)) {
            $count = Yii::app()->db->createCommand()
                    ->select("count(*) as count")
                    ->from("news_read")
                    ->where("user_id=" . Yii::app()->request->cookies['id']->value . " and news_id=" . $model->id)
                    ->queryScalar();
            if ($count == '0') {
                Yii::app()->db->createCommand("insert into news_read values (" . $model->id . "," . Yii::app()->request->cookies['id']->value . ")")->execute();
            }


            $this->render('/play/news/detail_unread', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/playnews/index'));
        }
    }

    /**
     * Download attachment
     */
    public function actionDownload() {
        $attachment_index = 0;
        if (isset($_GET['1'])) {
            $attachment_index = 1;
        } else if (isset($_GET['2'])) {
            $attachment_index = 2;
        } else if (isset($_GET['3'])) {
            $attachment_index = 3;
        }
        if ($attachment_index != 0) {//download from detail                   
            $file_path = Upload_file_common::getAttachmentById($_GET['id'], $attachment_index, 'news');
        } else {//download from registconfirm
            $file_path = $_GET['file_name'];
        }
        Yii::import('ext.helpers.EDownloadHelper');
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_path);
        exit;
    }

    /**
     * loadModel
     */
    public function loadModel() {
        if ($this->_news === null) {
            if (isset($_GET['id'])) {
                $this->_news = News::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_news = new News();
            }
        }
        return $this->_news;
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('news_regist_from') ? Yii::app()->request->cookies['news_regist_from']->value : '';

        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(
                array('application.extensions.PerformanceFilter - regist'),
            );
        } else {
            return array(
                'accessControl',
            );
        }
    }

    public function actionCheckId() {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $id = Yii::app()->db->createCommand("select id from $table where id=$id limit 1")->queryScalar();
        if ($id == FALSE) {
            echo '0';
        } else {
            echo $id;
        }
    }

}
