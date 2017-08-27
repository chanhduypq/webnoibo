<?php

class Adminhobby_itdController extends Controller {

	public $pageTitle;
    private $_hobby_itd = null;

    /**
     * 
     */
    public function init() {
        parent::init();
		$this->pageTitle=  Config::TITLE_FOR_MODULE_THANK;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('hobby_itd_regist_from') ? Yii::app()->request->cookies['hobby_itd_regist_from']->value : '';
        $backCookie1 = Yii::app()->request->cookies->contains('hobby_itd_edit_from') ? Yii::app()->request->cookies['hobby_itd_edit_from']->value : '';

        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(
                array('application.extensions.PerformanceFilter - regist'),
            );
        } else if ($backCookie1 != "" && $backCookie1 != NULL && $backCookie1 != "null") {
            return array(
                array('application.extensions.PerformanceFilter - edit'),
            );
        } else {
            return array(
                'accessControl',
            );
        }
    }

    /*     * Create Date:23/07/2012
     * Update Date:
     * Author:
     * User change:
     * Description: display list soumu_news object
     * */

    public function actionIndex() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];       
            if(strpos($key, 'hobby_itd') !== FALSE){                
                unset(Yii::app()->request->cookies[$key]);                
            }           
        }
        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;
        $page_size = Config::LIMIT_ROW;
        /**
         * 
         */
        $item_count = Yii::app()->db->createCommand()
                ->select('count(*) as count')
                ->from('hobby_itd')
                ->where(FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true")
                ->queryScalar();
        /**
         * 
         */
        $hobby_itd = Yii::app()->db->createCommand()
                ->select(array(
                    'hobby_itd.id',
                    
                    'lastname',
                    'firstname',
                    'user.photo',
					'user.division',
                    'user.position'
					
					
                        )
                )
                ->from('hobby_itd')
                ->join('user', 'user.id=hobby_itd.user_id')
				
                ->where(FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true")
                ->limit($page_size, ($page - 1) * $page_size)
                ->order('hobby_itd.created_date desc')
                ->queryAll();
				
      
        /**
         * 
         */
        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);
        /**
         * 
         */
        $params = array('hobby_itd' => $hobby_itd,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);
        /**
         * 
         */
        $this->render('/admin/hobby_itd/index', $params);
    }

    private function getBaseById($id) {
        if(!is_numeric($id)){
            return '';
        }
        $branch_name = Yii::app()->db->createCommand()
                ->select('branch_name')
                ->from('base')
                ->where("id=$id")
                ->queryScalar();
        if ($branch_name == FALSE) {
            return '';
        }
        return $branch_name;
    }

   public function actionDownload() {        
        $file_path = $_GET['file_name'];
        Yii::import('ext.helpers.EDownloadHelper');
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_path);       
        exit;
    }

    public function actionRegist() {
        $parmas = array();
        $model = new Hobby_itd();
        if (Yii::app()->request->isAjaxRequest) {            
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		$unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id as unitid',
                    'post.id as postid',
                    'unit.unit_name',
                    'post.post_name',
					
                    
                    //'user.base_list'
                        )
                )
                ->from('unit')
                ->join("post", "unit.id=post.unit_id")
                ->where("unit.active_flag=1")
                ->order("unit.display_order asc")
                ->queryAll();
		
        $parmas['model'] = $model;
		$parmas['unit'] = $unit;
        $this->render('/admin/hobby_itd/regist', $parmas);
    }

    public function actionGetusers() {
        if (Yii::app()->request->isAjaxRequest) {
            $unit_id = Yii::app()->request->getParam('unit_id');
            $position_id = Yii::app()->request->getParam('position_id');
			$users    = Yii::app()->db->createCommand()
								     ->select('id,lastname,firstname')
								   ->from('user')
								   ->where("division =$unit_id and position=$position_id")								   
								   ->queryAll();
								   
            
            echo CJSON::encode($users);
            Yii::app()->end();
        }
    }
    public function actionGetuser() {
        if (Yii::app()->request->isAjaxRequest) {
            $user_id = Yii::app()->request->getParam('user_id');
            $users = Yii::app()->db->createCommand("select photo,firstname,lastname from user where id=$user_id")->queryAll();            
            echo CJSON::encode($users);
            Yii::app()->end();
        }
    }

   

    public function actionRegistconfirm() {
		
        $model = new Hobby_itd();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    $user_id=Yii::app()->db->createCommand()
                            ->select(array('count(*) as count'))
                            ->from("user")
                            ->where("id=".$model->user_id)
                            ->queryScalar()
                            ;
                    if($user_id=='0'){
                        $this->redirect(array('adminhobby_itd/regist'));
                    }
                    if ($model->save() == true) {
                        $this->redirect(array('adminhobby_itd/index'));
                    }
                }
            } else {
                $this->redirect(array('adminhobby_itd/regist'));
            }
        } else {
            $this->redirect(array('adminhobby_itd/index'));
        }
		$unit = Yii::app()->db->createCommand("select unit_name from unit where id=".$_POST['id_unit'])->queryRow();
                $post = Yii::app()->db->createCommand("select post_name from post where id=".$_POST['id_position'])->queryRow();
		
        $params=array();
        $params['model']=$model;
        $params['lastname']=$_POST['lastname'];
        $params['firstname']=$_POST['firstname'];
        $params['photo']=$_POST['photo'];
        $params['unit_name']=$unit['unit_name'];
        $params['post_name']=$post['post_name'];
        $this->render('/admin/hobby_itd/registconfirm', $params);
    }

    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminhobby_itd/index'));
        }
       
        $user_id=Yii::app()->db->createCommand()
                ->select(array('count(*) as count'))
                ->from("user")
                ->where("id=".$model->user_id)
                ->queryScalar()
                ;
        if($user_id=='0'){
            $this->redirect(array('adminhobby_itd/index'));
        }

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        
        $user = Yii::app()->db->createCommand("select photo,firstname,lastname,division,position from user where id=".$model->user_id)->queryRow();            
		$unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id as unitid',
                    'post.id as postid',
                    'unit.unit_name',
                    'post.post_name'
					
                    
                    
                        )
                )
                ->from('unit')
                ->join("post", "unit.id=post.unit_id")
                ->where("unit.active_flag=1")
                ->order("unit.display_order asc")
                ->queryAll();
				  
        $parmas['lastname']=$user['lastname'];
        $parmas['firstname']=$user['firstname'];
        $parmas['photo']=$user['photo'];
		
        $unit_id=Yii::app()->db->createCommand()
								   ->select('id')
								   ->from('unit')
								   ->where("id =".$user['division'])
								   
								   ->queryScalar();
        $post_id=Yii::app()->db->createCommand()
								   ->select('id')
								   ->from('post')
								   ->where("id =".$user['position'])
								   
								   ->queryScalar();
								   
		
               
        $parmas['post_unit_id']=$unit_id.'-'.$post_id;
        
        //$model->base_id=$base_list_array[0];
        $parmas['model'] = $model;
		$parmas['unit'] = $unit;
                
        $this->render('/admin/hobby_itd/edit', $parmas);
    }

    public function actionEditconfirm() {
        $model = $this->loadModel();        
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            
            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    $user_id=Yii::app()->db->createCommand()
                            ->select(array('count(*) as count'))
                            ->from("user")
                            ->where("id=".$model->user_id)
                            ->queryScalar()
                            ;
                    if($user_id=='0'){
                        $this->redirect(array('adminhobby_itd/edit/?id=' . $model->id));
                    }
                    if ($model->save() == true) {
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminhobby_itd/' . $page . ''));
                    }
                }
            } 
            else {                
                $this->redirect(array('adminhobby_itd/edit/?id=' . $model->id));
            }
        }
        else{
            $this->redirect(array('adminhobby_itd/index'));
        }
		$unit = Yii::app()->db->createCommand("select unit_name from unit where id='".$_POST['id_unit']."'")->queryRow();
                $post = Yii::app()->db->createCommand("select post_name from post where id=".$_POST['id_position'])->queryRow();
                
        $params=array();
        $params['model']=$model;
        if(isset($_POST['lastname'])&&  is_string($_POST['lastname'])&&trim($_POST['lastname'])!=""){
            $params['lastname']=$_POST['lastname'];
        $params['firstname']=$_POST['firstname'];
        $params['photo']=$_POST['photo'];
        }
        else{
            $user= Yii::app()->db->createCommand("select photo,lastname,firstname from user where id=".$model->user_id)->queryRow();
            $params['lastname']=$user['lastname'];
        $params['firstname']=$user['firstname'];
        $params['photo']=$user['photo'];
        }
        
        
        $params['unit_name']=$unit['unit_name'];
        $params['post_name']=$post['post_name'];
        $this->render('/admin/hobby_itd/editconfirm', $params);
    }

   

    /*     * Create Date:23/07/2012
     * Update Date:
     * Author:
     * User change:
     * Description:Method using load model Soumu_news
     * */

    public function loadModel() {
        if ($this->_hobby_itd === null) {
            if (isset($_GET['id'])) {
                $this->_hobby_itd = Hobby_itd::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Hobby_itd'])) {
                $data = $_POST['Hobby_itd'];
                $id = $data['id'];
                $this->_hobby_itd = Hobby_itd::model()->findbyPk(intval($id));
            } else {
                $this->_hobby_itd = new Hobby_itd();
            }
        }
        return $this->_hobby_itd;
    }

   
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $model = new Hobby_itd();
        $model->deleteByPk($id);
        $this->redirect(array('/adminhobby_itd/index'));
    }
    public function actionDeleteall() {
        $id = Yii::app()->request->getParam('id');
        $model = new Hobby_itd();
        $model->deleteAll();
        $this->redirect(array('/adminhobby_itd/index'));
    }

    

}