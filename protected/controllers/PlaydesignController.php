<?php

class PlaydesignController extends Controller {

    public $pageTitle;

    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_MODULE_DESIGN_COMMENT;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function actionIndex() {  
        
    }

    public function actionCommentajax() {
        if (Yii::app()->request->isAjaxRequest) {
            $user_id = Yii::app()->request->getParam('user_id');
            $design_comment_id = Yii::app()->request->getParam('design_comment_id');
            $row = Yii::app()->db->createCommand("select count(*) as count from design_comment_detail where user_id=$user_id")->queryScalar();
            if ($row == '0') {
                Yii::app()->db->createCommand("insert into design_comment_detail (design_comment_id,user_id) values ($design_comment_id,$user_id)")->execute();
            } else {
                Yii::app()->db->createCommand("update design_comment_detail set design_comment_id=$design_comment_id where user_id=$user_id")->execute();
            }
            Yii::app()->end();
        }
    }

}
