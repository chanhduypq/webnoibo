<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();    
    public $items = array();

    

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    

    

    public function accessRules() {        

        
        
        $userId = Yii::app()->request->cookies->contains('id') ? Yii::app()->request->cookies['id']->value : '';
        if (!empty($userId)) {
            $controller1 = Yii::app()->controller->id;
            $isAdmin = substr($controller1, 0, 4);
            if ($isAdmin == "admi") {
                $controller = substr($controller1, 5, strlen($controller1));
            } else {
                $controller = substr($controller1, 4, strlen($controller1));
            }
            $action = "";
            if (isset(Yii::app()->controller->action->id)) {
                $action = Yii::app()->controller->action->id;
            }
            $userModel = User::model()->findByPk($userId);
            $role_id = $userModel->role_id;
            $connection = Yii::app()->db;
            $command = $connection->createCommand();
            $command->select('baserole_id');
            $command->from('functions f');
            $command->join('role_management r', 'f.id=r.function_id');
            $command->where("f.controller='$controller' AND r.role_id='$role_id'");
            $role = $command->queryAll();
            $arrDeny = array("index", "detail", "regist", "delete", "edit", "detail_unread","unread","join","join_regist");
            $arr = array("logout", 'login');
            $arradmin = array("logout", 'login');
            $arrpost = array();
            if ($controller1 == "adminprofile") {
                $role[0]['baserole_id'] = Constants::$baserole['admin'];
            }            
            if ($controller1 == "admin") {
                $role[0]['baserole_id'] = Constants::$baserole['admin'];
            }
            if ($controller1 == "work") {
                $arr[] = 'index';
            }
            if (!empty($role)) {
                foreach ($role as $val) {
                    if ($val['baserole_id'] == Constants::$baserole['view']) {
                        $arr[] = 'index';
                        $arr[] = 'detail';
                        $arr[] = 'unread';
                        $arr[] = 'detail_unread';
                        $arr[] = 'join';
                        $arr[] = 'leave';
                        $arr[] = 'change';
                        $arr[] = "join_detail"; 
                        $arr[] = "leave_detail"; 
                        $arr[] = "change_detail"; 
                        
                        
                    }
                    if ($val['baserole_id'] == Constants::$baserole['post']) {
                        $arr[] = 'regist';
                        $arr[] = 'edit';
                        $arr[] = 'join_regist';                    
                        $arr[] = 'leave_regist';                    
                        $arr[] = 'change_regist';                    
                        $arradmin[] = "regist";
                        $arradmin[] = "index";
                        $arradmin[] = "join";
                        $arradmin[] = "leave";
                        $arradmin[] = "change";
                        $arradmin[] = "detail"; 
                        $arradmin[] = "join_detail"; 
                        $arradmin[] = "leave_detail"; 
                        $arradmin[] = "change_detail"; 
                        $arradmin[] = "edit";
                        $arradmin[] = "join_edit";
                        $arradmin[] = "change_edit";
                        $arradmin[] = "leave_edit";
                        $arradmin[] = 'delete';       
                        $arradmin[] = 'join_delete';    
                        $arradmin[] = 'change_delete';    
                        $arradmin[] = 'leave_delete';    
                    }
                    if ($val['baserole_id'] == Constants::$baserole['admin']) {
                        $arradmin[] = 'index';
                        $arradmin[] = "join";
                        $arradmin[] = "leave";
                        $arradmin[] = "change";
                        $arradmin[] = 'regist';
                        $arradmin[] = 'join_regist';                    
                        $arradmin[] = 'leave_regist';                    
                        $arradmin[] = 'change_regist';  
                        $arradmin[] = 'edit';
                        $arradmin[] = "join_edit";
                        $arradmin[] = "change_edit";
                        $arradmin[] = "leave_edit";
                        $arradmin[] = 'detail';
                        $arradmin[] = "join_detail"; 
                        $arradmin[] = "leave_detail"; 
                        $arradmin[] = "change_detail"; 
                        $arradmin[] = 'delete';  
                        $arradmin[] = 'join_delete';    
                        $arradmin[] = 'change_delete';    
                        $arradmin[] = 'leave_delete'; 
                    }
                }
                
                if ($isAdmin == "work") {
                    if (!in_array($action, $arr) && in_array($action, $arrDeny)) {
                        Yii::app()->setComponents(array('errorHandler' => array('errorAction' => 'general/error')));
                    }

                    return array(
                        array('allow',
                            'actions' => $arr,
                            'users' => array('*'),
                        ),
                        array('deny', // deny all users
                            'actions' => array("index", "detail", "regist", "delete", "edit", "detail_unread","unread","join","join_regist","change","change_regist","leave","leave_reigst","join_detail","leave_detail","leave_detail","leave_edit","join_edit","change_edit","change_delete","join_delete","leave_delete"),
                            'users' => array('*'),
                        ),
                    );
                } else if ($isAdmin == "admi") {
                    if (!in_array($action, $arradmin) && $action != "index" && in_array($action, $arrDeny)) {
                        Yii::app()->user->setFlash('deny', "Bạn không có quyền truy cập");
                        $this->redirect(array($controller1 . '/'));
                    }

                    return array(
                        array('allow',
                            'actions' => $arradmin,
                            'users' => array('*'),
                        ),
                        array('deny',
                            'actions' => array("index", "detail", "regist", "delete", "edit", "detail_unread","unread","join","join_regist","change","change_regist","leave","leave_reigst","join_detail","leave_detail","leave_detail","leave_edit","join_edit","change_edit","change_delete","join_delete","leave_delete"),
                            'users' => array('*'),
                        ),
                    );
                } else {
                    return array(
                        array('allow',
                            'actions' => array('logout', 'login'),
                            'users' => array('*'),
                        ),
                    );
                }
            } else {
                if ($controller1 != "work" && $isAdmin == "work" && $controller != "report") {
                    Yii::app()->user->setFlash('deny', "Bạn không có quyền truy cập");
                    $this->redirect(array('work/'));
                } else { 
                    Yii::app()->setComponents(array('errorHandler' => array('errorAction' => 'general/error')));
                }
                return array(
                    array('allow',
                        'users' => array('*'),
                    ),
                    array('deny', // deny all users                        
                        'actions' => array("index", "detail", "regist", "delete", "edit", "detail_unread","unread","join","join_regist","change","change_regist","leave","leave_reigst","join_detail","leave_detail","leave_detail","leave_edit","join_edit","change_edit","change_delete","join_delete","leave_delete"),
                        'users' => array('*'),
                    ),
                );
            }
        }
        return array(
            array('allow',
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'actions' => array("index", "detail", "regist", "delete", "edit", "detail_unread","unread","join","join_regist","change","change_regist","leave","leave_reigst","join_detail","leave_detail","leave_detail","leave_edit","join_edit","change_edit","change_delete","join_delete","leave_delete"),
                'users' => array('*'),
            ),
        );
    }

}
