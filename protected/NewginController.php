<?php

class NewginController extends Controller {

    public $pageTitle;

    /*     * $this->redirect('/work/index');
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    public function init() {
        parent::init();
        $this->pageTitle = "Singin";
    }

    public function actionIndex() {

        $model = new LoginForm();

        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $id_user = Yii::app()->db->createCommand("select * from user where employee_number='" . $_POST['LoginForm']['employee_number'] . "'")->queryRow();
                $cookie = new CHttpCookie('id', $id_user['id']);
                $passwd = new CHttpCookie('passwd', $id_user['passwd']);
                $passwd->secure = true;
                
                Yii::app()->request->cookies['id'] = $cookie;
                Yii::app()->request->cookies['passwd'] = $passwd;
                if ($id_user['passwd'] != 7581) {
                    $this->redirect(array('work/'));
                } else {
                    $this->redirect('adminprofile/detail/?id=' . $id_user['id']);
                }
            }
            else{
                $this->render('login', array('model' => $model,'error'=>true));
            }
        }


        $this->render('login', array('model' => $model));
    }

    public function actionPw() {
//        $this->pageTitle = "Login｜SMILE";
        $model = new Pw;
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (Yii::app()->request->isPostRequest) {
            CActiveForm::validate($model);
            if ($model->validate()) {
                
            }
        }

        $this->render('pw', array('model' => $model));
    }

    public function actionPw_complete() {
        $this->pageTitle = "LOGIN｜SMILE ";
        if (isset($_POST['Pw']['employee_number'])) {
            $pass = Yii::app()->db->createCommand("select * from user where employee_number=" . $_POST['Pw']['employee_number'])->queryRow();

            $body = "" . $pass['lastname'] . " " . $pass['firstname'] . "

Bạn đã gửi yêu cầu cấp lại mật khẩu.
Mật khẩu sẽ được gửi vào email đã đăng ký.

　Mật khẩu :" . $pass['passwd'] . "

Vì lý do bảo mật, yêu cầu bạn thay đổi lại mật khẩu sau khi đăng nhập.

";
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            Yii::import('ext.yii-mail.YiiMailMessage');
            $message = new YiiMailMessage;
            $message->setBody(mb_convert_encoding($body, 'UTF-8'));
            $message->subject = mb_convert_encoding(Yii::app()->params['subjectPw'], 'UTF-8');
            $message->addTo($_POST['Pw']['mailaddr']);
            $message->from = Yii::app()->params['adminReminderEmailTo'];
            $message->CharSet = 'iso-2022-jp';
            if (Yii::app()->mail->send($message) == true) {
                $this->redirect(array('/newgin/pw_complete'));
            }
        }
        $this->render('pw_complete');
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogout() {
        $cookie_collection = Yii::app()->request->cookies;
        $key_array = $cookie_collection->getKeys();
        for ($i = 0, $n = count($key_array); $i < $n; $i++) {
            $key = $key_array[$i];
            if (substr($key, 0, 4) == 'file') {
                if (Yii::app()->request->cookies[$key] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value)) {
                    unlink(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$key]->value);
                }
            }
        }

        Yii::app()->request->cookies->clear();
        Yii::app()->user->logout();
        unset(Yii::app()->session['lastname']);
        unset(Yii::app()->session['firstname']);
        $this->redirect(Yii::app()->homeUrl);
    }

}
