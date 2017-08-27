<?php

class AdmindesigncommentController extends Controller {

	public $pageTitle;
    private $_thanks = null;

    /**
     * 
     */
    public function init() {
        parent::init();
		$this->pageTitle=  Config::TITLE_FOR_MODULE_DESIGN_COMMENT;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('designcomment_regist_from') ? Yii::app()->request->cookies['designcomment_regist_from']->value : '';
        $backCookie1 = Yii::app()->request->cookies->contains('designcomment_edit_from') ? Yii::app()->request->cookies['designcomment_edit_from']->value : '';

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
            if (strpos($key, 'designcomment') !== FALSE) {                
                unset(Yii::app()->request->cookies[$key]);
            }
        }
        
        $moods = Yii::app()->db->createCommand()
                ->select("*")                
                ->from('design_comment')        
                ->order('name')
                ->queryAll();
				
       
        $params = array('moods' => $moods);
        /**
         * 
         */
        $this->render('/admin/designcomment/index', $params);
    }

    

    public function actionRegist() {
        $parmas = array();
        $model = new Designcomment();
        if (Yii::app()->request->isAjaxRequest) {            
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		
		
        $parmas['model'] = $model;
		
        $this->render('/admin/designcomment/regist', $parmas);
    }

   

   

    public function actionRegistconfirm() {
		
        $model = new Designcomment();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    
                    if ($model->save() == true) {
                        $this->redirect(array('admindesigncomment/index'));
                    }
                }
            } else {
                $this->redirect(array('admindesigncomment/regist'));
            }
        } else {
            $this->redirect(array('admindesigncomment/index'));
        }
		
		
        $params=array();
        $params['model']=$model;
        
        $this->render('/admin/designcomment/registconfirm', $params);
    }

    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('admindesigncomment/index'));
        }

        
       

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        
       
        $parmas['model'] = $model;
		
        $this->render('/admin/designcomment/edit', $parmas);
    }

    public function actionEditconfirm() {
        $model = $this->loadModel();        
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            
            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    
                    if ($model->save() == true) {
                        
                        $this->redirect(array('admindesigncomment/' ));
                    }
                }
            } 
            else {                
                $this->redirect(array('admindesigncomment/edit/?id=' . $model->id));
            }
        }
        else{
            $this->redirect(array('admindesigncomment/index'));
        }
		
        $params=array();
        $params['model']=$model;
        
        $this->render('/admin/designcomment/editconfirm', $params);
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
                $this->_thanks = Designcomment::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Designcomment'])) {
                $data = $_POST['Designcomment'];
                $id = $data['id'];
                $this->_thanks = Designcomment::model()->findbyPk(intval($id));
            } else {
                $this->_thanks = new Designcomment();
            }
        }
        return $this->_thanks;
               
    }

   
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $model = new Designcomment();
        $model->deleteByPk($id);
        Yii::app()->db->createCommand("delete from design_comment_detail where design_comment_id=$id")
                ->execute();
        $this->redirect(array('/admindesigncomment/index'));
    }
    

    

}