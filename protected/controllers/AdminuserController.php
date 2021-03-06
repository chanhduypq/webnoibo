<?php

class AdminuserController extends Controller {

    public $pageTitle;

    /**
     * 
     */
    public function init() {
        parent::init();
        $this->pageTitle = "user";
        if (Yii::app()->request->cookies['id'] == NULL) {
            $this->redirect(array('newgin/'));
        }
    }
    public function actionGetposts() {
        if (Yii::app()->request->isAjaxRequest) {
            $unit_id = Yii::app()->request->getParam('unit_id');
            
			$posts    = Yii::app()->db->createCommand()
								     ->select('id,post_name')
								   ->from('post')
								   ->where("unit_id=$unit_id")								   
								   ->queryAll();
								   
            
            echo CJSON::encode($posts);
            Yii::app()->end();
        }
    }
    public function actionGetpost() {
        if (Yii::app()->request->isAjaxRequest) {
            $post_id = Yii::app()->request->getParam('post_id');
            $posts = Yii::app()->db->createCommand("select post_name from post where id=$post_id")->queryAll();            
            echo CJSON::encode($posts);
            Yii::app()->end();
        }
    }

    protected function beforeAction($action) {
        if ($action->id == 'regist') {
            $beforeUrl = Yii::app()->request->urlReferrer;
            if (
                    strpos($beforeUrl, 'adminuser/regist') == FALSE && isset(Yii::app()->session['userregist'])
            ) {
                if (Yii::app()->request->cookies->contains('user_regist_from') && Yii::app()->request->cookies['user_regist_from']->value == 'confirm') {
                    
                } else {
                    $cookie_collection = Yii::app()->request->cookies;
                    $key_array = $cookie_collection->getKeys();
                    unset(Yii::app()->session['userregist']);
                    for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                        $key = $key_array[$i];
                        if (substr($key, 0, 16) == 'file_user_regist') {
                            if (file_exists(Yii::getPathOfAlias('webroot') . $_COOKIE[$key])) {
                                unlink(Yii::getPathOfAlias('webroot') . $_COOKIE[$key]);
                            }
                        }
                        if (substr($key, 0, 11) == 'user_regist' || substr($key, 0, 16) == 'file_user_regist') {
                            unset(Yii::app()->request->cookies[$key]);
                        }
                    }
                }
            }
        } else if ($action->id == 'edit') {
            $beforeUrl = Yii::app()->request->urlReferrer;
            if (
                    strpos($beforeUrl, 'adminuser/edit') == FALSE && isset(Yii::app()->session['useredit'])
            ) {
                if (Yii::app()->request->cookies->contains('user_edit_from') && Yii::app()->request->cookies['user_edit_from']->value == 'confirm') {
                    
                } else {
                    $cookie_collection = Yii::app()->request->cookies;
                    $key_array = $cookie_collection->getKeys();
                    unset(Yii::app()->session['useredit']);
                    for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                        $key = $key_array[$i];
                        if (substr($key, 0, 14) == 'file_user_edit') {
                            if (file_exists(Yii::getPathOfAlias('webroot') . $_COOKIE[$key])) {
                                unlink(Yii::getPathOfAlias('webroot') . $_COOKIE[$key]);
                            }
                        }
                        if (substr($key, 0, 9) == 'user_edit' || substr($key, 0, 14) == 'file_user_edit') {
                            unset(Yii::app()->request->cookies[$key]);
                        }
                    }
                }
            }
        }
        return parent::beforeAction($action);
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('user_edit_from') ? Yii::app()->request->cookies['user_edit_from']->value : '';
        $backCookie1 = Yii::app()->request->cookies->contains('user_regist_from') ? Yii::app()->request->cookies['user_regist_from']->value : '';

        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(
                array('application.extensions.PerformanceFilter - edit'),
            );
        } else if ($backCookie1 != "" && $backCookie1 != NULL && $backCookie1 != "null") {
            return array(
                array('application.extensions.PerformanceFilter - regist'),
            );
        } else {
            return array(
                'accessControl',
            );
        }
    }

    /**
     *     
     */
    private $_user = null;

    /**
     * 
     */
    public function actionIndex() {

        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;
        $page_size = Config::LIMIT_ROW;

        $item_count = Yii::app()->db->createCommand()
                ->select('count(*) as count')
                ->from('user')
                
                ->queryScalar();
        $users = Yii::app()->db->createCommand()
                ->select(array(
                    '*'
                        )
                )
                ->from('user')  
                
                ->limit($page_size, ($page - 1) * $page_size)
                ->order('convert(user.employee_number,UNSIGNED) ASC')
                ->queryAll();
        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);

        $post = Yii::app()->db->createCommand("select id, post_name from post")->queryAll();
        $params = array('users' => $users,
            'post' => $post,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);

        $this->render('/admin/user/index', $params);
    }

    public function actionEdit() {

        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminuser/index'));
        }
        
        $parmas = array();

        if (!isset($_POST['submit_active'])) {
            $temp = explode(" ", $model->birthday);
            $birthday_y_m_d = explode("-", $temp[0]);
            $model->birthday_year = $birthday_y_m_d[0];
            $model->birthday_month = intval($birthday_y_m_d[1]);
            $model->birthday_day = intval($birthday_y_m_d[2]);
        }

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $attachment4_error = isset(Yii::app()->session['attachment4']) ? Yii::app()->params['attachment4_error'] : '';

        unset(Yii::app()->session['attachment4']);


        $post = Yii::app()->db->createCommand("select post_name from post where id=".$model->position)->queryRow();
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name',                    
                        )
                )
                ->from('unit')
                
                ->where("unit.active_flag=1")
                ->order("unit.display_order asc")
                ->queryAll();


        $parmas['post_name'] = $post['post_name'];
        $parmas['unit'] = $unit;
        $parmas['attachment4_error'] = $attachment4_error;
        $parmas['model'] = $model;

        $this->render('/admin/user/edit', $parmas);
    }

    

    /**
     * 
     */
    public function actionEditconfirm() {
        $params = array();
        /**
         * 
         */
        $model = $this->loadModel();
        if ($model == NULL) {
            $this->redirect(array('adminuser/index'));
        }
        if (Yii::app()->request->isPostRequest) {
            Yii::app()->session['useredit'] = 'true';
            $message = CActiveForm::validate($model);
            if (!isset($_POST['edit']) || $_POST['edit'] != '1') {
                Upload_file_common_new::processAttachmentsuser($model, 2);
            }
            if ($message != "[]" && $model->photo_checkbox_for_deleting != '1') {
                $params['invalid'] = TRUE;
            }
            /**
             *
             */
            if ($model->validate() || $model->photo_checkbox_for_deleting == '1') {
                /**
                 *
                 */
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {

                    if ($model->save() == true) {
                        unset(Yii::app()->session['useredit']);
                        $cookie_collection = Yii::app()->request->cookies;
                        $key_array = $cookie_collection->getKeys();
                        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                            $key = $key_array[$i];
                            if (substr($key, 0, 9) == 'user_edit' || substr($key, 0, 14) == 'file_user_edit') {
                                unset(Yii::app()->request->cookies[$key]);
                            }
                        }
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminuser/' . $page . ''));
                    }
                }
            } else {
                if ($model->getError("photo") != "") {
                    Yii::app()->session['attachment4'] = true;
                }
                if ($model->photo != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->photo)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->photo);
                }
                unset(Yii::app()->session['useredit']);
                $cookie_collection = Yii::app()->request->cookies;
                $key_array = $cookie_collection->getKeys();
                for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                    $key = $key_array[$i];
                    if (substr($key, 0, 9) == 'user_edit' || substr($key, 0, 14) == 'file_user_edit') {
                        unset(Yii::app()->request->cookies[$key]);
                        if (substr($key, 0, 4) == 'file') {
                            if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                                unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                            }
                        }
                    }
                }
                $this->redirect(array('adminuser/edit/?id=' . $model->id));
            }
        } else {
            if (Yii::app()->request->cookies['page'] != NULL && Yii::app()->request->cookies['page']->value != "1") {
                $page = "index?page=" . Yii::app()->request->cookies['page']->value;
            } else {
                $page = "";
            }
            $this->redirect(array('adminuser/' . $page . ''));
        }

        
        $unit = Yii::app()->db->createCommand("select unit_name from unit where id=".$model->division)->queryRow();
        

        $params['model'] = $model;
        
        $params['unit'] = $unit;
        $params['unit_name']=$unit['unit_name'];
        
        if(isset($_POST['post_name'])&&  is_string($_POST['post_name'])&&trim($_POST['post_name'])!=""){
            $params['post_name']=$_POST['post_name'];
        }
        else{
            $position= Yii::app()->db->createCommand("select post_name from post where id=".$model->position)->queryRow();
            $params['post_name']=$position['post_name'];
            
            
        }
        $this->render('/admin/user/editconfirm', $params);
    }

    /**
     * 
     */
    public function actionDetail() {
        if (!isset($_GET['id'])) {
            $this->redirect(array('adminuser/index'));
        }

        $user = Yii::app()->db->createCommand()
                ->select(array(
                    'user.id',
                    'employee_number',
                    'firstname',
                    'lastname',
                    'role_name',
                    'user.mailaddr',
                    'joindate',          
                    'comment',
                    'photo',
                    'unit.unit_name',                    
                    'post.post_name',
                    'birthday',
                    'chuc_vu'
                        )
                )
                ->from('user')
                ->leftJoin('role', 'user.role_id=role.id')
                ->leftJoin("post", "user.position=post.id")
                ->leftJoin("unit", "user.division=unit.id")
                ->where('user.id=:id', array('id' => $_GET['id']))
                ->queryRow()
        ;
        if ($user == FALSE) {
            $this->redirect(array('adminuser/index'));
        }
        /**
         * 
         */
        $post = Yii::app()->db->createCommand("select id, post_name from post")->queryAll();
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

        $this->render('/admin/user/detail', array(
            'user' => $user,
            'post' => $post,
            'unit' => $unit,
                )
        );
    }

    /**
     * 
     */
    public function actionDownload() {

        if (isset($_GET['id'])) {//download from detail    
            $file_path = Yii::app()->db->createCommand()->select('photo')->from('user')->where("id=$id")->queryScalar();
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
    public function actionRegist() {

        $parmas = array();

        $model = new User();
        $model->passwd = 'smile@gmorunsystem';
        $model->birthday_year = 1980;
        /**
         * 
         */
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                  
                        )
                )
                ->from('unit')                
                ->order("unit.display_order asc")
                ->queryAll();
        

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $attachment4_error = isset(Yii::app()->session['attachment4']) ? Yii::app()->params['attachment4_error'] : '';

        unset(Yii::app()->session['attachment4']);


        $parmas['attachment4_error'] = $attachment4_error;
        /**
         * 
         */
        $parmas['model'] = $model;
        $parmas['unit'] = $unit;
        
        $this->render('/admin/user/regist', $parmas);
    }

    /**
     * 
     */
    public function actionRegistconfirm() {

        $params = array();
        /**
         * 
         */
        $model = new User();
        $model->passwd = 'smile@gmorunsystem';

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

        $post = Yii::app()->db->createCommand("select id, post_name from post")->queryAll();

        /**
         * 
         */
        if (Yii::app()->request->isPostRequest) {
            Yii::app()->session['userregist'] = 'true';
            /**
             * 
             */
            $message = CActiveForm::validate($model);
            if (!isset($_POST['regist']) || $_POST['regist'] != '1') {
                Upload_file_common_new::processAttachmentsuser($model, 1);
            }
            if ($message != "[]" && $model->photo_checkbox_for_deleting != '1') {
                $params['invalid'] = TRUE;
            }
            /**
             *
             */
            if ($model->validate() || $model->photo_checkbox_for_deleting == '1') {
                /**
                 *
                 */
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    if(isset($_POST['User']['photo'])&&$_POST['User']['photo']!=""){
                        $model->photo = $_POST['User']['photo'];
                    }
                    

                    if ($model->save() == true) {
                        unset(Yii::app()->session['userregist']);
                        $cookie_collection = Yii::app()->request->cookies;
                        $key_array = $cookie_collection->getKeys();
                        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                            $key = $key_array[$i];
                            if (substr($key, 0, 11) == 'user_regist' || substr($key, 0, 16) == 'file_user_regist') {
                                unset(Yii::app()->request->cookies[$key]);
                            }
                        }
                        $this->redirect(array('adminuser/index'));
                    }
                }
            } else {
                if ($model->getError("photo") != "") {
                    Yii::app()->session['attachment4'] = true;
                }
                if ($model->photo != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->photo)) {
                    unlink(Yii::getPathOfAlias('webroot') . $model->photo);
                }
                unset(Yii::app()->session['userregist']);
                $cookie_collection = Yii::app()->request->cookies;
                $key_array = $cookie_collection->getKeys();
                for ($i = 0, $n = count($key_array); $i < $n; $i++) {
                    $key = $key_array[$i];
                    if (substr($key, 0, 11) == 'user_regist' || substr($key, 0, 16) == 'file_user_regist') {
                        unset(Yii::app()->request->cookies[$key]);
                        if (substr($key, 0, 4) == 'file') {
                            if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                                unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                            }
                        }
                    }
                }
                $this->redirect(array('adminuser/regist'));
            }
        } else {
            $this->redirect(array('adminuser/index'));
        }
        $params['model'] = $model;        
        $params['unit'] = $unit;
        $params['post_name']=$_POST['post_name'];
        $this->render('/admin/user/registconfirm', $params);
    }

    /**
     *      
     */
    public function loadModel() {
        if ($this->_user === null) {
            if (isset($_GET['id'])) {                
                $this->_user = User::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['User'])) {
                $data = $_POST['User'];
                $id = $data['id'];
                $this->_user = User::model()->findbyPk(intval($id));
            } else {
                $this->_user = new User();
            }
        }
        return $this->_user;
    }

    /**
     * 
     */
    public function actionDelete() {
        /**
         * 
         */
        $id = Yii::app()->request->getParam('id');
        /**
         * 
         */
        $model = new User();
        $model = $model->findByPk($id);        
        $attachment1 = $model->photo;
        $model->deleteByPk($id);
        if ($attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment1)) {
            unlink(Yii::getPathOfAlias('webroot') . $attachment1);
            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment1);
            if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
            }
        }
        /**
         * 
         */
        if ($id == Yii::app()->request->cookies['id']->value) {
            Yii::app()->request->cookies->clear();
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $this->redirect(array('/adminuser/index'));
        }
    }

    

    

    private function getPositionId($positon) {
        if ($positon == NULL || trim($positon) == "") {
            return NULL;
        }


        $positon = Yii::app()->db->createCommand("select id from post where post_name='$positon'")->queryScalar();
        if ($positon == FALSE || !is_numeric($positon)) {
            return NULL;
        }
        return $positon;
    }

   

    

    private function isDate($date) {
        if ($date == null || !is_string($date) || trim($date) == '') {
            return FALSE;
        }
        $temp = explode("/", $date);
        if (count($temp) != 3) {
            return FALSE;
        }
        $day = $temp[2];
        $month = $temp[1];
        $year = $temp[0];
        if ($day < 1 || $day > 31) {
            return FALSE;
        }
        if ($month == '4' || $month == '6' || $month == '9' || $month == '11') {
            if ($day > 30) {
                return FALSE;
            }
        } else if ($month == '2') {
            if ($day > 29) {
                return FALSE;
            }
            if ($year % 4 != 0 && $day == 29) {
                return FALSE;
            }
        }
        return true;
    }

}
