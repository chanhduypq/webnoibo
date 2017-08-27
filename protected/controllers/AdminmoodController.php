<?php

class AdminmoodController extends Controller {

	public $pageTitle;
    private $_thanks = null;

    /**
     * 
     */
    public function init() {
        parent::init();
		$this->pageTitle=  Config::TITLE_FOR_MODULE_MOOD;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('mood_regist_from') ? Yii::app()->request->cookies['mood_regist_from']->value : '';
        $backCookie1 = Yii::app()->request->cookies->contains('mood_edit_from') ? Yii::app()->request->cookies['mood_edit_from']->value : '';

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
            if(strpos($key, 'mood') !== FALSE){                
                unset(Yii::app()->request->cookies[$key]);                
            }           
        }
        
        $moods = Yii::app()->db->createCommand()
                ->select("*")                
                ->from('mood')        
                ->order('name')
                ->queryAll();
				
       
        $params = array('moods' => $moods);
        /**
         * 
         */
        $this->render('/admin/mood/index', $params);
    }

    

    public function actionRegist() {
        $parmas = array();
        $model = new Mood();
        if (Yii::app()->request->isAjaxRequest) {            
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		
		
        $parmas['model'] = $model;
		
        $this->render('/admin/mood/regist', $parmas);
    }

   

   

    public function actionRegistconfirm() {
		
        $model = new Mood();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {
                if (isset($_POST['regist']) && $_POST['regist'] == '1') {
                    
                    if ($model->save() == true) {
                        $this->redirect(array('adminmood/index'));
                    }
                }
            } else {
                $this->redirect(array('adminmood/regist'));
            }
        } else {
            $this->redirect(array('adminmood/index'));
        }
		
		
        $params=array();
        $params['model']=$model;
        
        $this->render('/admin/mood/registconfirm', $params);
    }

    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminmood/index'));
        }

        
       

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        
       
        $parmas['model'] = $model;
		
        $this->render('/admin/mood/edit', $parmas);
    }

    public function actionEditconfirm() {
        $model = $this->loadModel();        
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            
            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    
                    if ($model->save() == true) {
                        
                        $this->redirect(array('adminmood/' ));
                    }
                }
            } 
            else {                
                $this->redirect(array('adminmood/edit/?id=' . $model->id));
            }
        }
        else{
            $this->redirect(array('adminmood/index'));
        }
		
        $params=array();
        $params['model']=$model;
        
        $this->render('/admin/mood/editconfirm', $params);
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
                $this->_thanks = Mood::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Mood'])) {
                $data = $_POST['Mood'];
                $id = $data['id'];
                $this->_thanks = Mood::model()->findbyPk(intval($id));
            } else {
                $this->_thanks = new Mood();
            }
        }
        return $this->_thanks;
    }

   
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        $model = new Mood();
        $model->deleteByPk($id);
        Yii::app()->db->createCommand("delete from mood_detail where mood_id=$id")->execute();
        $this->redirect(array('/adminmood/index'));
    }
    

    

}