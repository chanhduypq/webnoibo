<?php

class WorkhrController extends Controller {

    public $pageTitle;
    private $_hr = null;
    private $_join = null;
    private $_change = null;
    private $_leave = null;

    public function init() {
        parent::init();
        $this->pageTitle = "Thông báo từ phòng hành chính nhân sự";
        if (Yii::app()->request->cookies['id'] == NULL) {
            $this->redirect(array('newgin/'));
        }
    }

    public function actionJoin() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();

        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (strpos($key, 'join') !== FALSE) {
                unset(Yii::app()->request->cookies[$key]);
            }
        }

        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = (FunctionCommon::isPostFunction("hr") && !FunctionCommon::isViewFunction("hr")) ? "contributor_id=" . Yii::app()->session['id'] : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Join::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = Join::model()->findAll($criteria);

        $this->render('/work/hr/join', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    public function actionChange() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();

        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (strpos($key, 'change') !== FALSE) {
                unset(Yii::app()->request->cookies[$key]);
            }
        }

        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = (FunctionCommon::isPostFunction("hr") && !FunctionCommon::isViewFunction("hr")) ? "contributor_id=" . Yii::app()->session['id'] : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Change::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = Change::model()->findAll($criteria);

        $this->render('/work/hr/change', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    public function actionLeave() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();

        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (strpos($key, 'leave') !== FALSE) {
                unset(Yii::app()->request->cookies[$key]);
            }
        }

        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = (FunctionCommon::isPostFunction("hr") && !FunctionCommon::isViewFunction("hr")) ? "contributor_id=" . Yii::app()->session['id'] : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Leave::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = Leave::model()->findAll($criteria);

        $this->render('/work/hr/leave', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    /**
     * display list hr
     */
    public function actionIndex() {

        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();

        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (strpos($key, 'hr') !== FALSE) {
                if (substr($key, 0, 4) == 'file') {
                    if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                        unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                    }
                }
                unset(Yii::app()->request->cookies[$key]);
            }
        }

        //set cookie
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $cookie = new CHttpCookie('page', $page);
        Yii::app()->request->cookies['page'] = $cookie;

        $criteria = new CDbCriteria();
        $criteria->select = 'id,title,content,created_date,attachment1,attachment2,attachment3';
        $criteria->condition = (FunctionCommon::isPostFunction("hr") && !FunctionCommon::isViewFunction("hr")) ? "contributor_id=" . Yii::app()->session['id'] : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Hr::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $model = Hr::model()->findAll($criteria);

        $this->render('/work/hr/index', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    /**
     * Regist 
     */
    public function actionRegist() {
        $parmas = array();
        $model = $this->loadModel();
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
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
        $this->render('/work/hr/regist', $parmas);
    }

    public function actionJoin_regist() {
        $parmas = array();
        $model = $this->loadModelJoin();
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                        )
                )
                ->from('unit')
                ->order("unit.display_order asc")
                ->queryAll();
        $parmas['model'] = $model;
        $parmas['unit'] = $unit;
        $this->render('/work/hr/join_regist', $parmas);
    }
    public function actionLeave_regist() {
        $parmas = array();
        $model = $this->loadModelLeave();
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                        )
                )
                ->from('unit')
                ->order("unit.display_order asc")
                ->queryAll();
        $parmas['model'] = $model;
        $parmas['unit'] = $unit;
        $this->render('/work/hr/leave_regist', $parmas);
    }
    public function actionChange_regist() {
        $parmas = array();
        $model = $this->loadModelChange();
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $unit = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.id',
                    'unit.unit_name'
                        )
                )
                ->from('unit')
                ->order("unit.display_order asc")
                ->queryAll();
        $parmas['model'] = $model;
        $parmas['unit'] = $unit;
        $this->render('/work/hr/change_regist', $parmas);
    }

    /**
     * Regist confirm
     */
    public function actionRegistconfirm() {
        $model = $this->loadModel();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['regist']) || $_POST['regist'] != '1') {

                Upload_file_common_new::processAttachments($model, 'hr', 1);
            }
            if ($model->validate()) {

                if (isset($_POST['regist']) && $_POST['regist'] == '1') {

                    $model->attachment1 = $_POST['Hr']['attachment1'];
                    $model->attachment2 = $_POST['Hr']['attachment2'];
                    $model->attachment3 = $_POST['Hr']['attachment3'];
                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('work/'));
                        } else {
                            $this->redirect(array('workhr/index'));
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
                $this->redirect(array('workhr/regist'));
            }
        } else {
            $this->redirect(array('workhr/index'));
        }
        $this->render('/work/hr/registconfirm', array('model' => $model));
    }

    public function actionJoin_registconfirm() {
        $model = $this->loadModelJoin();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['regist']) && $_POST['regist'] == '1') {


                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('work/'));
                        } else {
                            $this->redirect(array('workhr/join'));
                        }
                    }
                }
            } else {

                $this->redirect(array('workhr/join_regist'));
            }
        } else {
            $this->redirect(array('workhr/join'));
        }
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
        $params = array();
        $params['model'] = $model;
        $params['unit'] = $unit;
        $params['post_name'] = $_POST['post_name'];
        $this->render('/work/hr/join_registconfirm', $params);
    }
    public function actionLeave_registconfirm() {
        $model = $this->loadModelLeave();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['regist']) && $_POST['regist'] == '1') {


                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('work/'));
                        } else {
                            $this->redirect(array('workhr/leave'));
                        }
                    }
                }
            } else {

                $this->redirect(array('workhr/leave_regist'));
            }
        } else {
            $this->redirect(array('workhr/leave'));
        }
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
        $params = array();
        $params['model'] = $model;
        $params['unit'] = $unit;
        $params['post_name'] = $_POST['post_name'];
        $this->render('/work/hr/leave_registconfirm', $params);
    }
    public function actionChange_registconfirm() {
        $model = $this->loadModelChange();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['regist']) && $_POST['regist'] == '1') {


                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('work/'));
                        } else {
                            $this->redirect(array('workhr/change'));
                        }
                    }
                }
            } else {

                $this->redirect(array('workhr/change_regist'));
            }
        } else {
            $this->redirect(array('workhr/change'));
        }
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
        $params = array();
        $params['model'] = $model;
        $params['unit'] = $unit;
        $params['post_name'] = $_POST['post_name'];
        $params['to_post_name'] = $_POST['to_post_name'];
        $this->render('/work/hr/change_registconfirm', $params);
    }

    public function actionDetail() {

        $model = $this->loadModel();



        if (!empty($model->title)) {


            $this->render('/work/hr/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/workhr/index'));
        }
    }

    public function actionJoin_detail() {


        $member_join = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.unit_name',
                    'post.post_name',
                    'member_join.member_name',
                    'member_join.join_date',
                    'member_join.detail',
                    'member_join.contributor_id',
                    'member_join.created_date',
                    'member_join.last_updated_date'
                        )
                )
                ->from('member_join')
                ->leftJoin("post", "member_join.position=post.id")
                ->leftJoin("unit", "member_join.unit=unit.id")
                ->where('member_join.id=:id', array('id' => $_GET['id']))
                ->queryRow()
        ;


        if (is_array($member_join) && count($member_join) > 0) {


            $this->render('/work/hr/join_detail', array(
                'member_join' => $member_join
                    )
            );
        } else {
            $this->redirect(array('/workhr/join'));
        }
    }

    public function actionLeave_detail() {


        $member_leave = Yii::app()->db->createCommand()
                ->select(array(
                    'unit.unit_name',
                    'post.post_name',
                    'member_leave.member_name',
                    'member_leave.leave_date',
                    'member_leave.detail',
                    'member_leave.contributor_id',
                    'member_leave.created_date',
                    'member_leave.last_updated_date'
                        )
                )
                ->from('member_leave')
                ->leftJoin("post", "member_leave.position=post.id")
                ->leftJoin("unit", "member_leave.unit=unit.id")
                ->where('member_leave.id=:id', array('id' => $_GET['id']))
                ->queryRow()
        ;


        if (is_array($member_leave) && count($member_leave) > 0) {


            $this->render('/work/hr/leave_detail', array(
                'member_leave' => $member_leave
                    )
            );
        } else {
            $this->redirect(array('/workhr/leave'));
        }
    }

    public function actionChange_detail() {


        $member_change = Yii::app()->db->createCommand()
                ->select(array(
                    'member_change.from_position',
                    'member_change.from_unit',
                    'member_change.to_position',
                    'member_change.to_unit',
                    'member_change.member_name',
                    'member_change.change_date',
                    'member_change.detail',
                    'member_change.contributor_id',
                    'member_change.created_date',
                    'member_change.last_updated_date'
                        )
                )
                ->from('member_change')                
                ->where('member_change.id=:id', array('id' => $_GET['id']))
                ->queryRow()
        ;




        if (is_array($member_change) && count($member_change) > 0) {
            if ($member_change['from_position'] != "") {
                $member_change['from_position'] = Yii::app()->db->createCommand()
                        ->select("post_name")
                        ->from("post")
                        ->where("id=" . $member_change['from_position'])
                        ->queryScalar();
                if ($member_change['from_position'] == FALSE) {
                    $member_change['from_position'] = "";
                }
            }
            if ($member_change['from_unit'] != "") {
                $member_change['from_unit'] = Yii::app()->db->createCommand()
                        ->select("unit_name")
                        ->from("unit")
                        ->where("id=" . $member_change['from_unit'])
                        ->queryScalar();
                if ($member_change['from_unit'] == FALSE) {
                    $member_change['from_unit'] = "";
                }
            }
            if ($member_change['to_position'] != "") {
                $member_change['to_position'] = Yii::app()->db->createCommand()
                        ->select("post_name")
                        ->from("post")
                        ->where("id=" . $member_change['to_position'])
                        ->queryScalar();
                if ($member_change['to_position'] == FALSE) {
                    $member_change['to_position'] = "";
                }
            }
            if ($member_change['to_unit'] != "") {
                $member_change['to_unit'] = Yii::app()->db->createCommand()
                        ->select("unit_name")
                        ->from("unit")
                        ->where("id=" . $member_change['to_unit'])
                        ->queryScalar();
                if ($member_change['to_unit'] == FALSE) {
                    $member_change['to_unit'] = "";
                }
            }


            $this->render('/work/hr/change_detail', array(
                'member_change' => $member_change
                    )
            );
        } else {
            $this->redirect(array('/workhr/change'));
        }
    }

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
            $file_path = Upload_file_common::getAttachmentById($_GET['id'], $attachment_index, 'hr');
        } else {//download from registconfirm
            $file_path = $_GET['file_name'];
        }
        Yii::import('ext.helpers.EDownloadHelper');
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . $file_path);
        exit;
    }

    /**
     * loadModel
     */
    public function loadModel() {
        if ($this->_hr === null) {
            if (isset($_GET['id'])) {
                $this->_hr = Hr::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_hr = new Hr();
            }
        }
        return $this->_hr;
    }

    public function loadModelJoin() {
        if ($this->_join === null) {
            if (isset($_GET['id'])) {
                $this->_join = Join::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_join = new Join();
            }
        }
        return $this->_join;
    }
    public function loadModelLeave() {
        if ($this->_leave === null) {
            if (isset($_GET['id'])) {
                $this->_leave = Leave::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_leave = new Leave();
            }
        }
        return $this->_leave;
    }
    public function loadModelChange() {
        if ($this->_change === null) {
            if (isset($_GET['id'])) {
                $this->_change = Change::model()->findbyPk(intval($_GET['id']));
            } else {
                $this->_change = new Change();
            }
        }
        return $this->_change;
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('hr_regist_from') ? Yii::app()->request->cookies['hr_regist_from']->value : '';

        if ($backCookie != "" && $backCookie != NULL && $backCookie != "null") {
            return array(
                array('application.extensions.PerformanceFilter - regist'),
            );
        } else {
            return array(
                'accessControl',
            );
        }
    }

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

}
