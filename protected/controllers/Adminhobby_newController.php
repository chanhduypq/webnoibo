<?php

class Adminhobby_newController extends Controller {

    public $pageTitle;

    //check if logined or not
    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_HOBBY_NEW;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('hobby_new_edit_form') ? Yii::app()->request->cookies['hobby_new_edit_form']->value : '';
        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(array('application.extensions.PerformanceFilter - edit'),);
        } else {
            return array('accessControl',);
        }
    }

    /*
     * Create Date:20130823
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:Method using load model hobby_new
     * */

    private $_hobby_new = null;

    public function loadModel() {
        if ($this->_hobby_new === null) {
            if (isset($_GET['id'])) {
                $this->_hobby_new = Hobby_new::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Hobby_new'])) {
                $data = $_POST['Hobby_new'];
                $id = $data['id'];
                $this->_hobby_new = Hobby_new::model()->findbyPk(intval($id));
            } else {
                $this->_hobby_new = new Hobby_new();
            }
        }
        return $this->_hobby_new;
    }

    

    

    

    public function actionCheckId() {
        $id = $_POST['id'];
        $row = 0;
        $object = Yii::app()->db->createCommand("select * from hobby_new where id=" . $id)->queryRow();
        if (!empty($object['id'])) {
            $row = 1;
        }
        echo $row;
    }

    
    public function actionIndex() {
        
        
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();

        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (strpos($key, 'hobby_new') !== FALSE) {
                if (substr($key, 0, 4) == 'file') {
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
        $criteria->condition = FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Hobby_new::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = Hobby_new::model()->findAll($criteria);

        $this->render('/admin/hobby_new/index', array('model' => $model, 'pages' => $pages, 'item_count' => $item_count, 'page_size' => Yii::app()->params['listPerPage']));
    }

    /** Create Date:20130823
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action display info Detail object Hobby_new  
     * */
    public function actionDetail($id) {
        $model = $this->loadModel();
        
        if (!empty($model->title)) {
            $this->render('/admin/hobby_new/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/adminhobby_new/index'));
        }
    }

    /** Create Date:23/07/2012
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action using update info object report  
     * */
    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if (count($model) > 0) {
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            $attachment1_error = isset(Yii::app()->session['attachment1']) ? Yii::app()->params['attachment1_error'] : '';
            
            unset(Yii::app()->session['attachment1']);
            
            $parmas['model'] = $model;
            $parmas['attachment1_error'] = $attachment1_error;            
            $this->render('/admin/hobby_new/edit', $parmas);
        } else {
            $this->redirect(array('adminhobby_new/index'));
        }
    }

    /** Create Date:20130823
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action display info edit model hobby_new  
     * */
    public function actionEditConfirm() {
        $model = $this->loadModel();
        if (count($model) > 0 && Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['edit']) || $_POST['edit'] != '1') {
                Upload_file_common_new::processOneFileImg($model, 'hobby_new', 2);
            }
            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    $model->attachment1 = $_POST['Hobby_new']['attachment1'];
                    if ($model->save()) {
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminhobby_new/' . $page . ''));
                    }
                }
            } else {
                if ($model->getError("attachment1") != "") {
                    Yii::app()->session['attachment1'] = true;
                }


                /*                 * * */
                if ($model->attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment1)) {
                    if ($model->attachment1 != Upload_file_common::getAttachmentById($model->id, 1, 'hobby_new')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment1);
                    }
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
                $this->redirect(array('adminhobby_new/edit/?id=' . $model->id));
            }
            $this->render('/admin/hobby_new/editconfirm', array('model' => $model));
        } else {
            $this->redirect(array('adminhobby_new/index'));
        }
    }

    /** Create Date:20130910
     * Update Date:
     * Author:Hainhl
     * User change:
     * Description:action using delete object hobby_new 
     * */
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $model = Hobby_new::model();
        
        $model = $model->findByPk($id);

        if (!is_null($model)) {
            $attachment1 = $model->attachment1;


            $model->deleteByPk($id);

            Yii::app()->db->createCommand()->delete("update_information", "table_name=:table_name and article_id=:article_id", array("article_id" => $id, "table_name" => 'hobby_new',));


            

            if ($attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment1)) {
                    unlink(Yii::getPathOfAlias('webroot') . $attachment1);
                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment1);
                    if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                        unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                    }
                }
            $this->redirect(array('adminhobby_new/index'));
        }
    }

}

?>