<?php
class WorkController extends Controller
{
	public $pageTitle;
	public function init() 
	{
        parent::init();
		$this->pageTitle=  Config::TITLE_FOR_TOP_MAJIME;
        if (Yii::app()->request->cookies['id'] == NULL  ) {
         	$this->redirect(array('newgin/'));
        }
          
    }
	public function actionIndex()
	{
            //$this->sendMail();
		$cookie = new CHttpCookie('beforelink', "work");
		Yii::app()->request->cookies['beforelink'] = $cookie;
        $this->render('index');
	}
        private function sendMail(){
            mb_language('Japanese');
                    mb_internal_encoding('UTF-8');
                    Yii::import('ext.yii-mail.YiiMailMessage');
                    $message = new YiiMailMessage;
                    $mailaddr='メールアドレス: tuetc@runsystem.net';
                    
                    
                    $content="wb noi bo";
                    
$body="$mailaddr 


問い合わせ内容：
$content";
                    $message->setBody(mb_convert_encoding(trim($body), 'iso-2022-jp'));
                    $message->subject = mb_convert_encoding("abc", 'iso-2022-jp');
					//$mailsTo = Yii::app()->params['adminInquiryEmailTo'];
					/*Change by VuNDH*/
//                    if(!empty($mailsTo)) {
//                    	foreach ($mailsTo as $mail) {
//                    		$message->addTo($mail);
//                    	}
//                    }
//                    var_dump($mailsTo);
//                    var_dump(Yii::app()->params['adminEmail']);
//                    exit;
                    $message->addTo("tuetc@runsystem.net");                    
                    $message->from = "tue12a31218@yahoo.com";
                    $message->CharSet = 'iso-2022-jp';
                    var_dump(Yii::app()->mail->send($message));
                    
                    
        }
	
}
