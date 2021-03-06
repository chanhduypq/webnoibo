<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/style.css" rel="stylesheet" media="screen"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/pager.css" rel="stylesheet" media="screen"/>
        <?php 
        
        if (Yii::app()->request->cookies['id'] == null) { 
        ?>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
        <?php
        }
        if (isset(Yii::app()->session['lastime'])) {
            if (time() - Yii::app()->session['lastime'] > Config::TIME_OUT) {
                Yii::app()->request->cookies->clear();
                Yii::app()->user->logout();
                $this->redirect(Yii::app()->request->baseUrl . '/newgin');
            }
        }
        if (Yii::app()->request->cookies['id'] != NULL) {
            Yii::app()->session['lastime'] = time();
        }
        ?>
        <title><?php echo isset($this->pageTitle) ? $this->pageTitle : 'Singin'; ?></title>
        <?php
        if (Yii::app()->getController()->getId() == 'play') {
        ?>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/toppage.css" rel="stylesheet" type="text/css">
        <?php
        }
        ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/function.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery.cookies.js"></script>        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/common.js"></script>
        <style>
            p.notes{        
                word-break: normal !important;
            }
        </style>
    </head>
    <body id="work">
        <header id="top">
            <div class="wrapper">
                <?php
                if (Yii::app()->request->cookies['id'] != NULL) {
                    if (!isset(Yii::app()->session['lastname']) || !isset(Yii::app()->session['firstname'])) {
                        $row = Yii::app()->db->createCommand()
                                ->select(array("lastname", "firstname"))
                                ->from("user")
                                ->where("id=" . Yii::app()->request->cookies['id']->value)
                                ->queryRow()
                        ;
                        if (is_array($row) && count($row) > 0) {
                            Yii::app()->session['lastname'] = $row['lastname'];
                            Yii::app()->session['firstname'] = $row['firstname'];
                        }
                    }
                    ?>
                    <div class="link_top">
                        <div class="l_link fl">
                            <span>Xin chào <b class="blue"><?php echo Yii::app()->session['lastname'] . ' ' . Yii::app()->session['firstname']; ?></b></span>
                        </div>
                        <div class="r_link fr">
                            <ul class="admin_link">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/">Quản trị</a></li>
                                <li>
                                    <a onclick="alert('Chức năng này chưa được thực hiện')">
                                        Hướng dẫn sử dụng
                                    </a>
<!--                                    <a href="
                                    <?php 
                                    if (isset(Yii::app()->request->cookies['passwd'])&&Yii::app()->request->cookies['passwd']->value == 'smile@gmorunsystem'){
                                        echo '#';
                                    }
                                    else{
                                        echo '/help';
                                    }
                                    ?>
                                       " target="_blank">Hướng dẫn sử dụng
                                    </a>-->
                                </li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/newgin/Logout">Thoát</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
                <div class="logo_tab">
                    <div class="logo">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/logo.png"/>
                    </div>
                    <?php 
                    if (Yii::app()->request->cookies['id'] != NULL) { 
                    ?>
                        <div class="nav_tab">
                            <a href="<?php echo Yii::app()->baseUrl; ?>/play" style="margin-right: 20px;"><img id="vui_choi_img" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/vuichoi.png"></a>
<!--                            <a onclick="alert('Chức năng này chưa được thực hiện')"><img id="cong_viec_img" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/congviec.png"></a>-->
                            <a href="<?php echo Yii::app()->baseUrl; ?>/work"><img id="cong_viec_img" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/congviec.png"></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <?php 
        if (Yii::app()->request->cookies['id'] != NULL) { 
        ?>
            <div class="wrapper">
                <div class="banner">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/banner.jpg">
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset(Yii::app()->request->cookies['passwd'])&&Yii::app()->request->cookies['passwd']->value == 'smile@gmorunsystem') {
            $get_id_p = Yii::app()->getController()->getAction()->getId();
            $get_ac_p = Yii::app()->getController()->getId();
            if (($get_id_p == 'edit' && $get_ac_p != 'adminprofile') || $get_id_p == 'editconfirm' || $get_id_p == 'index' || ($get_id_p == 'detail' && $get_ac_p != 'adminprofile') || $get_ac_p == 'work' || $get_ac_p == 'admin' || $get_ac_p == 'play') {
                $this->redirect(Yii::app()->request->baseUrl . '/adminprofile/detail/?id=' . Yii::app()->request->cookies['id']->value);
            }
            ?>	
            <script type='text/javascript'>

                $(document).ready(function() {
                    $('a').removeAttr('href');
                    $('a').removeAttr('onclick');
                    $('button').removeAttr('type');
                });
            </script>
        <?php
        } 
        else {
            $get_id = Yii::app()->getController()->getAction()->getId();
            $get_ac = Yii::app()->getController()->getId();
            $get_Controlles = substr($get_ac, 5);

            $array_Ac = array(                            
                            'adminideas',                             
                            'admincriticism',                             
                            'adminhobby_itd', 
                            'adminhobby_new'
                        );
            if (FunctionCommon::isAdmin() == FALSE && (FunctionCommon::isPostFunction($get_Controlles)) && (FunctionCommon::isContributorFunction($get_Controlles)) == false) {
                if (($get_id == 'detail' && (in_array($get_ac, $array_Ac))) || ($get_id == 'edit' && (in_array($get_ac, $array_Ac))) || ($get_id == 'editconfirm' && (in_array($get_ac, $array_Ac))) || ($get_ac == 'admincelebrate' && ($get_id == 'categoryedit' || $get_id == 'categoryregist')) || ($get_ac == 'adminsoumu_qa' && ($get_id == 'categoryedit' || $get_id == 'categoryregist'))) {
                    $this->redirect(array(Yii::app()->request->baseUrl . 'general/error'));
                }
            }            
            $array_Ac_new = array(
                                'adminuser', 
                                'adminrole',                                 
                                'adminpost',                                                                 
                                'adminthanks',                                 
                            );
            if (FunctionCommon::isAdmin() == FALSE) {
                $get_ac = Yii::app()->getController()->getId();
                if (in_array($get_ac, $array_Ac_new)) {
                    $this->redirect(array(Yii::app()->request->baseUrl . 'general/error'));
                }
            }
        }
        
        $action = Yii::app()->getController()->getAction()->getId();
        if ($action != "regist" && $action != "edit" && $action != "add") {
            unset(Yii::app()->session['attachment1']);
            unset(Yii::app()->session['attachment2']);
            unset(Yii::app()->session['attachment3']);
            unset(Yii::app()->session['attachment4']);
        }
        if (Yii::app()->request->cookies['id'] != NULL || (Yii::app()->getController()->getId() == 'newgin')) {
            echo '<div class="container">';
            echo $content;
            echo '</div>';
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='newgin/';</SCRIPT>");
        }
        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {    
            echo '<div id="footer-main">';
        }
        else{
            echo '<footer id="footer-main">';
        }
        ?>
        
        
            <div class="wrapper">
                <div class="link_footer"> 
                    <span>Copyright ©2014 GMO RUNSYSTEM Corporation. All rights reserved</span>
                </div>
                <div class="back-to-top">
                    <a style="cursor: pointer;" id="bttop"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/back-to-top.png"></a>
                </div>
            </div>
        
        <?php
        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {    
            echo '</div>';
        }
        else{
            echo '</footer>';
        }
        ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            function returnBackStatus(url){
                if(url.indexOf("work")==-1){
                    jQuery("img#cong_viec_img").attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/congviec.png");
                }   
                if(url.indexOf("play")==-1){
                    jQuery("img#vui_choi_img").attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/vuichoi.png");
                }   
            }
            jQuery(function($) {                                        
                var url=window.location.href;
                jQuery("img#cong_viec_img").mouseover(function (){
                    jQuery(this).attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/congviec_active.png");
                });
                jQuery("img#cong_viec_img").mouseout(function (){
                    returnBackStatus(url);                                         
                });
                jQuery("img#vui_choi_img").mouseover(function (){
                    jQuery(this).attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/vuichoi_active.png");
                });
                jQuery("img#vui_choi_img").mouseout(function (){
                    returnBackStatus(url);                                         
                });
                if(url.indexOf("work")!=-1&&url.indexOf("play")==-1){
                    jQuery("img#cong_viec_img").attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/congviec_active.png");
                }
                else if(url.indexOf("play")!=-1){                                            
                    jQuery("img#vui_choi_img").attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/vuichoi_active.png");
                }
                page = '<?php echo Yii::app()->request->getParam('page', '1'); ?>';
                pageCount = $("input#page_count").val();
                if(pageCount>0){
                    lis = $('ul.pagination').find('li');
                    href= $(lis[0]).find("a").eq(0).attr("href");
                    var spanText='';
                    if(lis.length>0){
                        if(page=='1'){
                            spanText+='<span class="disabled">First</span><span class="disabled">Previous</span>';
                        }
                        else{
                            spanText+=$(lis[0]).html()+'<a href="'+href+'/page/'+(page-1)+'">Previous</a>';
                        }
                        for (i = 2, n = lis.length-2; i < n; i++) {
                            if ($(lis[i]).find('a').eq(0).html() == page) {
                                spanText+='<span class="current">'+page+'</span>';
                            }
                            else{
                                spanText+=$(lis[i]).html();
                            }

                        }

                        if(page==pageCount){
                            spanText+='<span class="disabled">Next</span><span class="disabled">Last</span>';
                        }
                        else{
                            spanText+='<a href="'+href+'/page/'+(++page)+'">Next</a>'+$(lis[lis.length-1]).html();
                        }
                    }
                    $("div#pagination").html(spanText);
                }
                $('ul.pagination').remove();
            });
            var unitedit_from = getCookie("unitedit_from");
            if (unitedit_from != "" && unitedit_from != null && unitedit_from != 'null') {
                deleteCookies("unitedit_from");
            }
            var office_edit_from = getCookie("office_edit_from");
            if (office_edit_from != "" && office_edit_from != null && office_edit_from != 'null') {
                deleteCookies("office_edit_from");
            }
            var office_regist_from = getCookie("office_regist_from");
            if (office_regist_from != "" && office_regist_from != null && office_regist_from != 'null') {
                deleteCookies("office_regist_from");
            }
            var base_edit_from = getCookie("unit_edit_from");
            if (base_edit_from != "" && base_edit_from != null && base_edit_from != 'null') {
                deleteCookies("unit_edit_from");
            }
            var base_regist_from = getCookie("unit_regist_from");
            if (base_regist_from != "" && base_regist_from != null && base_regist_from != 'null') {
                deleteCookies("unit_regist_from");
            }
            var user_edit_from = getCookie("user_edit_from");
            if (user_edit_from != "" && user_edit_from != null && user_edit_from != 'null') {
                deleteCookies("user_edit_from");
            }
            var user_regist_from = getCookie("user_regist_from");
            if (user_regist_from != "" && user_regist_from != null && user_regist_from != 'null') {
                deleteCookies("user_regist_from");
            }
        </script>                                

    </body>
</html>
