<?php

class Playhobby_newController extends Controller {

    public $pageTitle;

    //check if logined or not
    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_HOBBY_NEW;
        if (Yii::app()->request->cookies['id'] == NULL) {
            $this->redirect(Yii::app()->baseUrl . '/index.php');
        }
        
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('hobby_new_regist_form') ? Yii::app()->request->cookies['hobby_new_regist_form']->value : '';
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
                $this->_hobbynews = Hobby_new::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_hobbynews = new Hobby_new();
            }
        }
        return $this->_hobbynews;
    }

    

    
    public function actionIndex() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];       
            if(strpos($key, 'hobby_new') !== FALSE){
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
        $newest_row = Yii::app()->db->createCommand()
                ->select("*")
                ->from("hobby_new")
                ->order("created_date DESC")
                ->limit("1")
                ->queryRow()
        ;        
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = ((FunctionCommon::isPostFunction("hobby_new") && !FunctionCommon::isViewFunction("hobby_new")) ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true") . " and id <>" . $newest_row['id'];
        $criteria->order = 'created_date DESC';

        try{
            $item_count = Hobby_new::model()->count($criteria);
            $pages = new CPagination($item_count);

            $pages->pageSize = 4;
            $pages->applyLimit($criteria);

            $model = Hobby_new::model()->findAll($criteria);
        }
        catch(Exception $e){
            $item_count=0;
            $pages = new CPagination($item_count);

            $pages->pageSize = 4;
            $pages->applyLimit($criteria);

            $model = array();
        }
        

        $this->render('/play/hobby_new/index', array('model' => $model, 'pages' => $pages, 'item_count' => $item_count, 'page_size' => 4, 'newest_row' => $newest_row));
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
        $this->render('/play/hobby_new/regist', $parmas);
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
                Upload_file_common_new::processOneFileImg($model, 'hobby_new', 1);
            }
            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {

                    $model->attachment1 = $_POST['Hobby_new']['attachment1'];
                    
                    if ($model->save()) {
                        if (FunctionCommon::isViewFunction("hobby_new") == false) {
                            $this->redirect(array('play/'));
                        } else {
                            $this->redirect(array('playhobby_new/index'));
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
                $this->redirect(array('playhobby_new/regist'));
            }
        } else {
            // $this->redirect(array('playhobby_new/index'));
        }
        $this->render('/play/hobby_new/registconfirm', array('model' => $model));
    }

    /** Create Date:18/11/2013
     * Update Date:
     * Author:Baodt
     * User change:
     * Detail id hobby_new & view valuation table hobby_new comment width id hobby_new
     * */
    public function actionDetail() {

        $model = $this->loadModel();

        

        if (!empty($model->title)) {

            $this->render('/play/hobby_new/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/playhobby_new/index'));
        }
    }

}
