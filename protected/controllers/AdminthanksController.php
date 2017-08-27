<?php

class AdminthanksController extends Controller {

	public $pageTitle;
    private $_thanks = null;

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
        $backCookie = Yii::app()->request->cookies->contains('thanks_regist_from') ? Yii::app()->request->cookies['thanks_regist_from']->value : '';
        $backCookie1 = Yii::app()->request->cookies->contains('thanks_edit_from') ? Yii::app()->request->cookies['thanks_edit_from']->value : '';

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
            if(strpos($key, 'thanks') !== FALSE){                
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
                ->from('thanks')
                ->where(FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true")
                ->queryScalar();
        /**
         * 
         */
        $thanks = Yii::app()->db->createCommand()
                ->select(array(
                    'thanks.id',
                    'thanks.comment',
                    'lastname',
                    'firstname',
                    'user.photo',
					'user.division',
                    'user.position'
					
					
                        )
                )
                ->from('thanks')
                ->join('user', 'user.id=thanks.user_id')
				//->join('unit', 'unit.id=user.division1 or unit.id=user.division2 or unit.id=user.division3 or unit.id=user.division4')
                ->where(FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true")
                ->limit($page_size, ($page - 1) * $page_size)
                ->order('thanks.created_date desc')
                ->queryAll();
				
      
        /**
         * 
         */
        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);
        /**
         * 
         */
        $params = array('thanks' => $thanks,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);
        /**
         * 
         */
        $this->render('/admin/thanks/index', $params);
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
        $model = new Thanks();
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
        $this->render('/admin/thanks/regist', $parmas);
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
		
        $model = new Thanks();
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
                        $this->redirect(array('adminthanks/regist'));
                    }
                    if ($model->save() == true) {
                        $this->redirect(array('adminthanks/index'));
                    }
                }
            } else {
                $this->redirect(array('adminthanks/regist'));
            }
        } else {
            $this->redirect(array('adminthanks/index'));
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
        $this->render('/admin/thanks/registconfirm', $params);
    }

    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminthanks/index'));
        }
       
        $user_id=Yii::app()->db->createCommand()
                ->select(array('count(*) as count'))
                ->from("user")
                ->where("id=".$model->user_id)
                ->queryScalar()
                ;
        if($user_id=='0'){
            $this->redirect(array('adminthanks/index'));
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
                    'post.post_name',
					
                    
                    //'user.base_list'
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
                
        $this->render('/admin/thanks/edit', $parmas);
    }
    public function actionDetail() {
        
        
        

        if (Yii::app()->request->isAjaxRequest) {
            $thank_id=Yii::app()->request->getParam("id");
            
            $row=Yii::app()->db->createCommand()
                    ->select(array(
                        "photo",
                        "firstname",
                        "lastname",
                        "unit_name",
                        "post_name",
                        "sender",
                        "thanks.comment",
                    ))
                    ->from("thanks")
                    ->join("user", "user.id=thanks.user_id")
                    ->join("unit", "unit.id=user.division")
                    ->join("post", "post.id=user.position")
                    ->where("thanks.id=$thank_id")
                    ->queryRow();

            $html_string=$this->returnHtml($row);
            echo $html_string;            
            Yii::app()->end();
        }

        
        
                
        
    }
    private function returnHtml($row){?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin">
   
        <div class="contents confirm">
        	
            <div class="mainBox detail">
            	
                <div class="box">


                
                    <div class="cnt-box">
                    <div class="form-horizontal">

                        <div class="control-group">
                            <label for="title" class="control-label">Chi nhánh - bộ phận&nbsp;</label>
                            <div class="controls">
                                    <p>
								<?php 
								
								
								 echo htmlspecialchars($row['unit_name']). ' - '.htmlspecialchars($row['post_name']);
								 
								?></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="title" class="control-label">Nhân viên&nbsp;</label>
                            <div class="controls">
                                    <p><?php echo htmlspecialchars($row['lastname']).' '.htmlspecialchars($row['firstname']);?></p>
                            </div>
                        </div>
                        <?php if($row['photo']!=""){?>
                        <div class="control-group">
                            <label for="title" class="control-label"></label>
                            <div class="controls">
                                    <div class="picture"><img style="height: 52px;" src="<?php echo $row['photo'];?>"></div>
                            </div>
                        </div>
                        <?php }?>
                        <div class="control-group">
                            <label for="content" class="control-label">Nội dung&nbsp;</label>
                            <div class="controls">
                                    <p><?php echo nl2br(htmlspecialchars($row['comment']));?>	
                                    </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="content" class="control-label">Người gửi tin&nbsp;</label>
                            <div class="controls">
                                    <p><?php echo htmlspecialchars($row['sender']);?></p>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>                   
                        
                    
                    </div><!-- /cnt-box -->	
            		
        
    
       	   
	                

                </div><!-- /box -->
            </div><!-- /mainBox -->

            
            
        </div><!-- /contents -->
        

</div>


<?php
        
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
                        $this->redirect(array('adminthanks/edit/?id=' . $model->id));
                    }
                    if ($model->save() == true) {
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminthanks/' . $page . ''));
                    }
                }
            } 
            else {                
                $this->redirect(array('adminthanks/edit/?id=' . $model->id));
            }
        }
        else{
            $this->redirect(array('adminthanks/index'));
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
        $this->render('/admin/thanks/editconfirm', $params);
    }

   

    /*     * Create Date:23/07/2012
     * Update Date:
     * Author:
     * User change:
     * Description:Method using load model Soumu_news
     * */

    public function loadModel() {
        if ($this->_thanks === null) {
            if (isset($_GET['id'])) {
                $this->_thanks = Thanks::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Thanks'])) {
                $data = $_POST['Thanks'];
                $id = $data['id'];
                $this->_thanks = Thanks::model()->findbyPk(intval($id));
            } else {
                $this->_thanks = new Thanks();
            }
        }
        return $this->_thanks;
    }

   
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $model = new Thanks();
        $model->deleteByPk($id);
        $this->redirect(array('/adminthanks/index'));
    }
    public function actionDeleteall() {
        $id = Yii::app()->request->getParam('id');
        $model = new Thanks();
        $model->deleteAll();
        $this->redirect(array('/adminthanks/index'));
    }

    

}