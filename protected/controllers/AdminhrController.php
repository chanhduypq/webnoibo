<?php

class AdminhrController extends Controller {

    public $pageTitle;
    private $_hr = null;
    private $_join = null;
    private $_change = null;
    private $_leave = null;

    public function init() {
        parent::init();
        $this->pageTitle = "Thông báo từ phòng hành chính nhân sự";
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
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
        $criteria->select = '*';
        $criteria->condition = FunctionCommon::isAdmin() == FALSE ? "contributor_id=" . Yii::app()->request->cookies['id']->value : "true";
        $criteria->order = 'created_date DESC';

        $item_count = Hr::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->pageSize = Yii::app()->params['listPerPage'];
        $pages->applyLimit($criteria);

        $ide = Hr::model()->findAll($criteria);
        $this->render('/admin/hr/index', array(
            'ide' => $ide,
            'pages' => $pages, 'item_count' => $item_count, 'page_size' => Yii::app()->params['listPerPage']));
    }

    /**
     * edit record id
     */
    public function actionEdit() {
        $parmas = array();
        $model = $this->loadModel();
        if ($model == null || !isset($_GET['id'])) {
            $this->redirect(array('adminhr/index'));
        }

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
        $this->render('/admin/hr/edit', $parmas);
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
                $file_type = $model->attachment1_file_type;
                $content = base64_decode($model->attachment1_file_bytes);
            } else if ($attachment_id == '2') {
                $file_name = $model->attachment2_file_name;
                $file_type = $model->attachment2_file_type;
                $content = base64_decode($model->attachment2_file_bytes);
            } else if ($attachment_id == '3') {
                $file_name = $model->attachment3_file_name;
                $file_type = $model->attachment3_file_type;
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
                        ->from('hr')
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
     * edit confir,
     */
    public function actionEditconfirm() {

        $model = $this->loadModel();
        if ($model == NULL) {
            $this->redirect(array('adminhr/index'));
        }        
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if (!isset($_POST['edit']) || $_POST['edit'] != '1') {
                Upload_file_common_new::processAttachments($model, 'hr', 2);
            }

            if ($model->id == null || $model->id == '') {
                $this->redirect(array('adminhr/index'));
            }

            if ($model->validate()) {
                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                    $model->attachment1 = $_POST['Hr']['attachment1'];
                    $model->attachment2 = $_POST['Hr']['attachment2'];
                    $model->attachment3 = $_POST['Hr']['attachment3'];
                    if ($model->save() == true) {
                        if (Yii::app()->request->cookies['page'] != NULL) {
                            $page = "index?page=" . Yii::app()->request->cookies['page']->value;
                        } else {
                            $page = "";
                        }
                        $this->redirect(array('adminhr/' . $page . ''));
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
                    if ($model->attachment1 != Upload_file_common::getAttachmentById($model->id, 1, 'hr')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment1);
                    }
                }
                if ($model->attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment2)) {
                    if ($model->attachment2 != Upload_file_common::getAttachmentById($model->id, 2, 'hr')) {
                        unlink(Yii::getPathOfAlias('webroot') . $model->attachment2);
                    }
                }
                if ($model->attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment3)) {
                    if ($model->attachment3 != Upload_file_common::getAttachmentById($model->id, 3, 'hr')) {
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
                $this->redirect(array('adminhr/edit/?id=' . $model->id));
            }
        } else {
            $this->redirect(array('adminhr/index'));
        }
        $this->render('/admin/hr/editconfirm', array('model' => $model));
    }

    

    /**
     * Detail id hr
     */
    public function actionDetail() {
        $model = $this->loadModel();


        if (!empty($model->title)) {
            $this->render('/admin/hr/detail', array(
                'model' => $model
                    )
            );
        } else {
            $this->redirect(array('/adminhr/index'));
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
     * load model
     */
    public function loadModel() {
        if ($this->_hr === null) {
            if (isset($_GET['id'])) {
                $this->_hr = Hr::model()->findbyPk(intval($_GET['id']));
            } else if (isset($_POST['Hr'])) {
                $data = $_POST['Hr'];
                $id = $data['id'];
                $this->_hr = Hr::model()->findbyPk(intval($id));
            } else {
                $this->_hr = new Hr();
            }
        }
        return $this->_hr;
    }

    /**
     * Delete Record id
     */
    public function actionDelete() {

        $id = Yii::app()->request->getParam('id');

        $model = new Hr();

        $model = $model->findByPk($id);
        if ($model == NULL) {
            return;
        }

        $attachment1 = $model->attachment1;
        $attachment2 = $model->attachment2;
        $attachment3 = $model->attachment3;

        

        $model->deleteByPk($id);
        Yii::app()->db->createCommand()->delete(
                "update_information", "table_name=:table_name and article_id=:article_id", array(
            "article_id" => $id,
            "table_name" => 'hr',
                ))
        ;


       

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

        $this->redirect(array('/adminhr/index'));
    }
    public function actionJoin_delete() {

        $id = Yii::app()->request->getParam('id');

        $model = new Join();   

        

        $model->deleteByPk($id);
        

        $this->redirect(array('/adminhr/join'));
    }
    public function actionChange_delete() {

        $id = Yii::app()->request->getParam('id');

        $model = new Change();   

        

        $model->deleteByPk($id);
        

        $this->redirect(array('/adminhr/change'));
    }
    public function actionLeave_delete() {

        $id = Yii::app()->request->getParam('id');

        $model = new Leave();   

        

        $model->deleteByPk($id);
        

        $this->redirect(array('/adminhr/leave'));
    }

    /**
     * check id hr
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
    public function actionChange_detail() {


        $member_change = Yii::app()->db->createCommand()
                ->select(array(
                    'member_change.id',
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


            $this->render('/admin/hr/change_detail', array(
                'member_change' => $member_change
                    )
            );
        } else {
            $this->redirect(array('/adminhr/change'));
        }
    }
    public function actionJoin_detail() {


        $member_join = Yii::app()->db->createCommand()
                ->select(array(
                    'member_join.id',
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


            $this->render('/admin/hr/join_detail', array(
                'member_join' => $member_join
                    )
            );
        } else {
            $this->redirect(array('/adminhr/join'));
        }
    }

    public function actionLeave_detail() {


        $member_leave = Yii::app()->db->createCommand()
                ->select(array(
                    'member_leave.id',
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


            $this->render('/admin/hr/leave_detail', array(
                'member_leave' => $member_leave
                    )
            );
        } else {
            $this->redirect(array('/adminhr/leave'));
        }
    }
    public function actionChange_edit() {
        $parmas = array();
        $model = $this->loadModelChange();
        $model->change_date=FunctionCommon::formatDate($model->change_date);
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
        $this->render('/admin/hr/change_edit', $parmas);
    }
    public function actionChange_editconfirm() {
        $model = $this->loadModelChange();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['edit']) && $_POST['edit'] == '1') {


                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('admin/'));
                        } else {
                            $this->redirect(array('adminhr/change'));
                        }
                    }
                }
            } else {

                $this->redirect(array('adminhr/change_edit/?id=' . $model->id));
            }
        } else {
            $this->redirect(array('adminhr/change'));
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
        $this->render('/admin/hr/change_editconfirm', $params);
    }
    public function actionJoin_edit() {
        $parmas = array();
        $model = $this->loadModelJoin();        
        $model->join_date=FunctionCommon::formatDate($model->join_date);
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
        $this->render('/admin/hr/join_edit', $parmas);
    }
    public function actionLeave_edit() {
        $parmas = array();
        $model = $this->loadModelLeave();
        $model->leave_date=FunctionCommon::formatDate($model->leave_date);
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
        $this->render('/admin/hr/leave_edit', $parmas);
    }
    public function actionJoin_editconfirm() {
        $model = $this->loadModelJoin();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['edit']) && $_POST['edit'] == '1') {
                   

                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('admin/'));
                        } else {
                            $this->redirect(array('adminhr/join'));
                        }
                    }
                }
            } else {

                $this->redirect(array('adminhr/join_edit/?id=' . $model->id));
            }
        } else {
            $this->redirect(array('adminhr/join'));
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
        $this->render('/admin/hr/join_editconfirm', $params);
    }
    public function actionLeave_editconfirm() {
        $model = $this->loadModelLeave();
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);

            if ($model->validate()) {

                if (isset($_POST['edit']) && $_POST['edit'] == '1') {


                    if ($model->save() == true) {

                        if (FunctionCommon::isViewFunction("hr") == false) {
                            $this->redirect(array('admin/'));
                        } else {
                            $this->redirect(array('adminhr/leave'));
                        }
                    }
                }
            } else {

                $this->redirect(array('adminhr/leave_edit/?id=' . $model->id));
            }
        } else {
            $this->redirect(array('adminhr/leave'));
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
        $this->render('/admin/hr/leave_editconfirm', $params);
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

        $this->render('/admin/hr/change', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
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

        $this->render('/admin/hr/join', array(
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

        $this->render('/admin/hr/leave', array(
            'pages' => $pages,
            'model' => $model,
            'item_count' => $item_count, 'page_size' => Config::LIMIT_ROW
        ));
    }

    public function filters() {
        $backCookie = Yii::app()->request->cookies->contains('hr_edit_from') ? Yii::app()->request->cookies['hr_edit_from']->value : '';

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
    public function loadModelJoin() {
        if ($this->_join === null) {
            if (isset($_GET['id'])) {
                $this->_join = Join::model()->findbyPk(intval($_GET['id']));
            }
            else if (isset($_POST['Join'])) {
                $data = $_POST['Join'];
                $id = $data['id'];
                $this->_join = Join::model()->findbyPk(intval($id));
            }
            else {
                $this->_join = new Join();
            }
        }
        return $this->_join;
    }
    public function loadModelLeave() {
        if ($this->_leave === null) {
            if (isset($_GET['id'])) {
                $this->_leave = Leave::model()->findbyPk(intval($_GET['id']));
            }
            else if (isset($_POST['Leave'])) {
                $data = $_POST['Leave'];
                $id = $data['id'];
                $this->_leave = Leave::model()->findbyPk(intval($id));
            }
            else {
                $this->_leave = new Leave();
            }
        }
        return $this->_leave;
    }
    public function loadModelChange() {
        if ($this->_change === null) {
            if (isset($_GET['id'])) {
                $this->_change = Change::model()->findbyPk(intval($_GET['id']));
            }
            else if (isset($_POST['Change'])) {
                $data = $_POST['Change'];
                $id = $data['id'];
                $this->_change = Change::model()->findbyPk(intval($id));
            }
            else {
                $this->_change = new Change();
            }
        }
        return $this->_change;
    }

}
