<?php

class Playwork_smileController extends Controller {

    public $pageTitle;

    //check if logined or not
    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_WORK_SMILE;
        if (Yii::app()->request->cookies['id'] == NULL) {
            $this->redirect(Yii::app()->baseUrl . '/index.php');
        }
       
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('work_smile_regist_form') ? Yii::app()->request->cookies['work_smile_regist_form']->value : '';
        if (!is_null($backCookie) && !empty($backCookie)) {
            return array(array('application.extensions.PerformanceFilter - regist'),);
        } else {
            return array('accessControl',);
        }
    }

    

    /*
     * Create Date:20130814
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:Method using load model Hobby_new
     * */

    private $_hobbynews = null;

    public function loadModel() {
        if ($this->_hobbynews === null) {
            if (isset($_GET['id'])) {
                $this->_hobbynews = Work_smile::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_hobbynews = new Work_smile();
            }
        }
        return $this->_hobbynews;
    }

    /** Create Date:20130822
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:Method using down load file
     * */
    public function actionDownload() {
        $attachment_index = 0;
        if (isset($_GET['1'])) {
            $attachment_index = 1;
        } else if (isset($_GET['2'])) {
            $attachment_index = 2;
        } else if (isset($_GET['3'])) {
            $attachment_index = 3;
        }
        if ($attachment_index != 0) {
            //download from detail                   
            $file_path = Upload_file_common::getAttachmentById($_GET['id'], $attachment_index, 'work_smile');
        } else {
            //download from registconfirm
            $file_path = $_GET['file_name'];
        }
        Yii::import('ext.helpers.EDownloadHelper');
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_path);

        exit;
    }

    
    public function actionIndex() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];       
            if(strpos($key, 'work_smile') !== FALSE){
                if(substr($key, 0, 4) == 'file'){
                    if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                        unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                    }
                }
                unset(Yii::app()->request->cookies[$key]);                
            }           
        }
        
        //set cookie page
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;
        
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = ((FunctionCommon::isPostFunction("work_smile") && !FunctionCommon::isViewFunction("work_smile")) ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true") ;
        $criteria->order = 'created_date DESC';

        $item_count = Work_smile::model()->count($criteria);
        $pages = new CPagination($item_count);

        $pages->pageSize = Config::LIMIT_ROW;
        $pages->applyLimit($criteria);

        $model = Work_smile::model()->findAll($criteria);

        $this->render('/play/work_smile/index', array('model' => $model, 'pages' => $pages, 'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW));
    }

    /** Create Date:20130814
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action using register object hobby_new  
     * */
    public function actionRegist() {
        $parmas = array();
        $model = $this->loadModel();

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        $attachment1_error = isset(Yii::app()->session['attachment1']) ? Yii::app()->params['attachment1_error'] : '';
        
        unset(Yii::app()->session['attachment1']);
        
        $parmas['attachment1_error'] = $attachment1_error;
        

        $parmas['model'] = $model;
        $this->render('/play/work_smile/regist', $parmas);
    }

    /** Create Date:20130815
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action display info register object hobby_new
     * */
    public function actionRegistConfirm() {
        $model = $this->loadModel();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['regist']) || $_POST['regist'] != '1') {
                Upload_file_common_new::processOneFileImg($model, 'work_smile', 1);
            }
            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {

                    $model->attachment1 = $_POST['Work_smile']['attachment1'];
                    
                    if ($model->save()) {
                        if (FunctionCommon::isViewFunction("work_smile") == FALSE) {
                            $this->redirect(array('play/'));
                        } else {
                            $this->redirect(array('playwork_smile/index'));
                        }
                    }
                }
            } else {
                if ($model->getError("attachment1") != "") {
                    Yii::app()->session['attachment1'] = true;
                }

                

                if ($model->attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment1)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->attachment1);
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
                $this->redirect(array('playwork_smile/regist'));
            }
        } else {
            // $this->redirect(array('playhobby_new/index'));
        }
        $this->render('/play/work_smile/registconfirm', array('model' => $model));
    }

    /** Create Date:18/11/2013
     * Update Date:
     * Author:Baodt
     * User change:
     * Detail id hobby_new & view valuation table hobby_new comment width id hobby_new
     * */
    public function actionDetail() {

        $model = $this->loadModel();

        $user = User::model()->findAll();


        if (!empty($model->title)) {

            $this->render('/play/work_smile/detail', array(
                'model' => $model,
                'user' => $user,
                    )
            );
        } else {
            $this->redirect(array('/playwork_smile/index'));
        }
    }

}
