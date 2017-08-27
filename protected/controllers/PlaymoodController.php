<?php

class PlaymoodController extends Controller {

    public $pageTitle;

    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_MOOD;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function actionIndex() {  
        
    }

    public function actionCommentajax() {
        if (Yii::app()->request->isAjaxRequest) {
            $user_id = Yii::app()->request->getParam('user_id');
            $mood_id = Yii::app()->request->getParam('mood_id');
            $now=date("Y-m-d H:i:s");
            Yii::app()->db->createCommand("insert into mood_detail (mood_id,user_id,create_date) values ($mood_id,$user_id,'$now')")->execute();
            Yii::app()->end();
        }
    }

}
