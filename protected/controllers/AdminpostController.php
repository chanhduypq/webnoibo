<?php

class AdminpostController extends Controller {

    public $pageTitle;
    private $_post = null;

    public function init() {
        parent::init();
        $this->pageTitle = "Chi nhánh";
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    /**
     * display list post
     */
    public function actionIndex() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];       
            if(strpos($key, 'post') !== FALSE){
                if(substr($key, 0, 4) == 'file'){
                    if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                        unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                    }
                }
                unset(Yii::app()->request->cookies[$key]);                
            }           
        }

        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;
        /**
         * 
         */
        $page_size = Config::LIMIT_ROW;
        /**
         * 
         */
        $item_count = Yii::app()->db->createCommand()
                ->select('count(*) as count')
                ->from('post')                
                ->queryScalar();
        /**
         * 
         */
        $posts = Yii::app()->db->createCommand()
                ->select(array(
                    'post_name',
                    'post.id',
                    'post.created_date',
                    'post.last_updated_date',
                    'unit_name'
                        )
                )
                ->from('post')
                ->join("unit", "unit.id=post.unit_id")
                ->limit($page_size, ($page - 1) * $page_size)
                ->order('unit_id desc, created_date desc')
                ->queryAll();
        /**
         * 
         */
        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);
        /**
         * 
         */
        $params = array('posts' => $posts,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);

        $this->render('/admin/post/index', $params);
        
    }
    public function actionRegist() {
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                  
                        )
                )
                ->from('unit')                
                ->order("unit.display_order asc")
                ->queryAll();
        $parmas = array();
        $model = new Post();
        if (Yii::app()->request->isAjaxRequest) {
            $error_string= CActiveForm::validate($model);
            $error_array=  CJSON::decode($error_string);
            if(!key_exists("Post_post_name", $error_array)){
                if($model->unit_id!=""){
                    $count=Yii::app()->db->createCommand("select count(*) as count from post where unit_id=".$model->unit_id." and post_name='".$model->post_name."'")->queryScalar();
                    if($count!=FALSE&&$count>0){                    
                        $unit_name=Yii::app()->db->createCommand("select unit_name from unit where id=".$model->unit_id)->queryScalar();
                        $error_array['Post_post_name']='Bộ phận này đã tồn tại trong chi nhánh "'.$unit_name.'"';
                    }        
                }
                
            }
            echo CJSON::encode($error_array);
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
        $parmas['unit'] = $unit;
        $this->render('/admin/post/regist', $parmas);
    }

    /**
     * Regist confirm
     */
    public function actionRegistconfirm() {
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',                    
                    'unit.unit_name'                   
                        )
                )
                ->from('unit')                
                ->where("unit.active_flag=1")
                ->order('unit.display_order ASC')
                ->queryAll();
        $model = new Post();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['regist']) || $_POST['regist'] != '1') {
                
                Upload_file_common_new::processAttachments($model, 'post', 1);
            }
            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    
                    $model->attachment1 = $_POST['Post']['attachment1'];
                    $model->attachment2 = $_POST['Post']['attachment2'];
                    $model->attachment3 = $_POST['Post']['attachment3'];
                    if ($model->save() == true) {
                        
                        if (FunctionCommon::isViewFunction("post") == false) {
                            $this->redirect(array('admin/'));
                        } else {
                            $this->redirect(array('adminpost/index'));
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
                $this->redirect(array('adminpost/regist'));
            }
        } else {
            $this->redirect(array('adminpost/index'));
        }
        $this->render('/admin/post/registconfirm', array('model' => $model,'unit'=>$unit));
    }

    /**
     * edit record id
     */
    public function actionEdit() {
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                  
                        )
                )
                ->from('unit')                
                ->order("unit.display_order asc")
                ->queryAll();
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminpost/index'));
        }
        

        if (Yii::app()->request->isAjaxRequest) {
            $error_string= CActiveForm::validate($model);
            $error_array=  CJSON::decode($error_string);
            if(!key_exists("Post_post_name", $error_array)){
                if($model->unit_id!=""){
                    $count=Yii::app()->db->createCommand("select count(*) as count from post where unit_id=".$model->unit_id." and post_name='".$model->post_name."' and id <> ".$model->id)->queryScalar();
                    if($count!=FALSE&&$count>0){                    
                        $unit_name=Yii::app()->db->createCommand("select unit_name from unit where id=".$model->unit_id)->queryScalar();
                        $error_array['Post_post_name']='Bộ phận này đã tồn tại trong chi nhánh "'.$unit_name.'"';
                    }        
                }
                
            }
            echo CJSON::encode($error_array);
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
        $parmas['unit'] = $unit;
        $this->render('/admin/post/edit', $parmas);
    }

    /**
     * edit confir,
     */
    public function actionEditconfirm() {

        $model = $this->loadModel();
        if ($model == NULL) {
            $this->redirect(array('adminpost/index'));
        }        
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['edit']) || $_POST['edit'] != '1') {
                Upload_file_common_new::processAttachments($model, 'post', 2);
            }

            if ($model->id == null || $model->id == '') {
                $this->redirect(array('adminpost/index'));
            }

            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    $model->attachment1 = $_POST['Post']['attachment1'];
                    $model->attachment2 = $_POST['Post']['attachment2'];
                    $model->attachment3 = $_POST['Post']['attachment3'];
                    if ($model->save() == true) {
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminpost/' . $page . ''));
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
                    if ($model->attachment1 != Upload_file_common::getAttachmentById($model->id, 1, 'post')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment1);
                    }
                }
                if ($model->attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment2)) {
                    if ($model->attachment2 != Upload_file_common::getAttachmentById($model->id, 2, 'post')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment2);
                    }
                }
                if ($model->attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment3)) {
                    if ($model->attachment3 != Upload_file_common::getAttachmentById($model->id, 3, 'post')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment3);
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
                $this->redirect(array('adminpost/edit/?id=' . $model->id));
            }
        } else {
            $this->redirect(array('adminpost/index'));
        }
        $unit = Yii::app()->db->createCommand("select unit_name from unit where id=".$model->unit_id)->queryRow();
        $this->render('/admin/post/editconfirm', array('model' => $model,'unit'=>$unit));
    }

    

    /**
     * Detail id Post
     */
    public function actionDetail() {
        $model = $this->loadModel();


        if (!empty($model->post_name)) {
            
            
            $this->render('/admin/post/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/adminpost/index'));
        }
    }

    /**
     * Download attachment
     */

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
            $file_path = Upload_file_common::getAttachmentById($_GET['id'], $attachment_index, 'post');
        } else {//download from registconfirm
            $file_path = $_GET['file_name'];
        }
        Yii::import('ext.helpers.EDownloadHelper');
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_path);
        exit;
    }
    /**
     * 
     */
    public function actionDownloadedit() {

        $model = $this->loadModel();
        if (isset($_POST['file_index'])) { //download file from file_bytes  		
            CActiveForm::validate($model);
            /**
             *
             */
            $model->validate();
            /**
             *
             */
            $attachment_id = $_POST['file_index'];
            /**
             *
             */
            if ($attachment_id == '1') {
                $file_name = $model->attachment1_file_name;
                $
                $content = base64_decode($model->attachment1_file_bytes);
            } else if ($attachment_id == '2') {
                $file_name = $model->attachment2_file_name;
                
                $content = base64_decode($model->attachment2_file_bytes);
            } else if ($attachment_id == '3') {
                $file_name = $model->attachment3_file_name;
                
                $content = base64_decode($model->attachment3_file_bytes);
            }
            /**
             *
             */
            header('Content-Type: ' . $file_type);
            header('Content-Disposition: attachment;filename="' . $file_name . '"');
            header('Cache-Control: max-age=0');
            echo $content;
        } else {//download file from host
            $attachment_id = 0;
            if (isset($_GET['1'])) {
                $attachment_id = 1;
            } else if (isset($_GET['2'])) {
                $attachment_id = 2;
            } else if (isset($_GET['3'])) {
                $attachment_id = 3;
            }
            if ($attachment_id != 0) {
                $file_name = Yii::app()->db->createCommand()
                        ->select('attachment' . $attachment_id)
                        ->from('post')
                        ->where('id=:id', array('id' => $_GET['id']))
                        ->queryScalar();
                /**
                 *
                 */
                if ($file_name != "" && file_exists(Yii::getPathOfAlias('webroot') . $file_name)) {
                    /**
                     * 
                     */
                    Yii::import('ext.helpers.EDownloadHelper');
                    EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_name);
                }
            }
        }
        exit;
    }

    

    /**
     * load model
     */
    public function loadModel() {
        if ($this->_post === null) {
            if (isset($_GET['id'])) {
                $this->_post = Post::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Post'])) {
                $data = $_POST['Post'];
                $id = $data['id'];
                $this->_post = Post::model()->findbyPk(intval($id));
            } else {
                $this->_post = new Post();
            }
        }
        return $this->_post;
                
    }

    /**
     * Delete Record id
     */
    public function actionDelete() {

        $id = Yii::app()->request->getParam('id');

        $model = new Post();

        $model = $model->findByPk($id);
        if ($model == NULL) {
            return;
        }
        

        $attachment1 = $model->attachment1;
        $attachment2 = $model->attachment2;
        $attachment3 = $model->attachment3;

        

        $model->deleteByPk($id);
       
        


        

        if ($attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment1)) {
                unlink(Yii::getPathOfAlias('webroot') . $attachment1);
                $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment1);
                if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                    unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                }
            }
            if ($attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment2)) {
                unlink(Yii::getPathOfAlias('webroot') . $attachment2);
                $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment2);
                if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                    unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                }
            }
            if ($attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment3)) {
                unlink(Yii::getPathOfAlias('webroot') . $attachment3);
                $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment3);
                if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                    unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                }
            }

        $this->redirect(array('/adminpost/index'));
    }

    /**
     * check id post
     */
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

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('post_edit_from') ? Yii::app()->request->cookies['post_edit_from']->value : '';

        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(
                array('application.extensions.PerformanceFilter - edit'),
            );
        } else {
            return array(
                'accessControl',
            );
        }
    }

}
