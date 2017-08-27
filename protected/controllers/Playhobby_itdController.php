<?php

class Playhobby_itdController extends Controller {

	public $pageTitle;
    private $_hobby_itd = null;

    public function init() {
        parent::init();
		$this->pageTitle=  Config::TITLE_FOR_MODULE_HOBBY_ITD;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    /**
     * 
     */
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
        $hobby_itds = Yii::app()->db->createCommand()
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
				//->join('unit', 'unit.id=user.division1 or unit.id=user.division2 or unit.id=user.division3 or unit.id=user.division4')
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
        $params = array('hobby_itds' => $hobby_itds,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);
        $this->render('/play/hobby_itd/index', $params);
    }

    
    

    
    

    

}