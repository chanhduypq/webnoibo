<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script type="text/javascript">
    

function checkFile(){
    
    var result	 = true;

    $("#error_message1").html("");
    $("#error_message1").removeClass("alert error_message");    
    $("#error_message1").html("");
    $("div#error_message1").removeClass("alert error_message");
    var checkBox1  = jQuery('#User_photo_checkbox_for_deleting').is(":checked");
    if(checkBox1==true){
        return true;
    }
    //check format file
    var arr_file	   = [".jpg" , ".gif", ".png", ".jpeg"];			
    var attachment1 = jQuery('#User_photo').val();

    checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
    checkFile1	   = checkFile1.toLowerCase();

    

    file1			   = jQuery.inArray(checkFile1, arr_file);
    

    if(checkBox1 == false && file1 == -1 && attachment1 !="")
    {
               jQuery("#error_message1").html("<?php echo Lang::MSG_0033; ?>");	
               jQuery("#error_message1").addClass("alert error_message");
               result = false;

    }
  
    return result;
}  
    function day(day_number) {
        jQuery('#User_birthday_day').html("");
        for (i = 1; i <= day_number; i++) {
            jQuery('#User_birthday_day').append("<option value=" + i + ">" + i + "</option>");
        }
    }

    jQuery(function($) {
        position1=getCookie("user_edit_position");
if(position1!=null&&position1!="null"){
    position1=position1;
}
else{
    position1='<?php echo $model->position;?>';
}
        var str_id=$("#User_division").val();
            
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+str_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#User_position').html("");
                                     jQuery('#User_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        if(position1==users[i].id){
                                            jQuery('#User_position').append("<option selected='selected' value=" + users[i].id + ">" + users[i].post_name + "</option>");
                                        }
                                        else{
                                            jQuery('#User_position').append("<option value=" + users[i].id + ">" + users[i].post_name + "</option>");
                                        }
                                        
                                    }    
                                }
                });
                $("#User_position").change(function() {
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+$(this).val(),    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                
           }); 
                       $("#User_position").click(function() {
    options=$("#User_position option");
    if(options.length==1&&$("#User_position").val()==""){
        alert("Vui lòng chọn Chi nhánh trước");
    }
});
        $("#User_division").change(function() {
            
            var str_id=$(this).val();
            if(str_id==''){
                str_id='-1';
            }
            
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+str_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#User_position').html("");
                                     jQuery('#User_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#User_position').append("<option value=" + users[i].id + ">" + users[i].post_name+"</option>");
                                    }    
                                }
                });
                
				
                
                
           });
$('input#User_photo_checkbox_for_deleting').click (function (){                  
                 if ($(this).is (':checked')){ 
                      $fileInput=$(this).parent().prev();
                      name=$fileInput.attr('name');
                      id=$fileInput.attr('id');
                      classAttr=$fileInput.attr('class'); 
                      if(name==undefined){
                          name="";
                      }
                      if(id==undefined){
                          id="";
                      }
                      if(classAttr==undefined){
                          classAttr="";
                      }
                      $fileInput.replaceWith("<input type='file' name='"+name+"' id='"+id+"' class='"+classAttr+"'/>");
                      //
                      nodes=$(this).parent().parent().parent().find('a');
                      if(nodes.length>0){
                          $node1=$(this).parent().parent().parent().find('a').eq(0);
                      }
                      else{
                          $node1=$(this).parent().parent().parent().find('img').eq(0);
                      }
                      
                      
                      $node1.remove();
                      $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_dummyman.jpg">').insertBefore($(this).parent().parent());                      
                 }
            });

           $("#user_form").attr('action', '<?php echo Yii::app()->baseUrl; ?>/adminuser/editconfirm/');    
        employee_number=getCookie("user_edit_employee_number");
        role_id=getCookie("user_edit_role_id");
        mailaddr=getCookie("user_edit_mailaddr");
        lastname=getCookie("user_edit_lastname");
        firstname=getCookie("user_edit_firstname");
        
        
        birthday_year=getCookie("user_edit_birthday_year");
        birthday_month=getCookie("user_edit_birthday_month");
        birthday_day=getCookie("user_edit_birthday_day");
        joindate=getCookie("user_edit_joindate");
        
        
        
        comment=getCookie("user_edit_comment");
		//begin 01/11/2013
		division=getCookie("user_edit_division");
		
		
		position=getCookie("user_edit_position");
		
       	//end
        
        photo_checkbox_for_deleting=getCookie("user_edit_photo_checkbox_for_deleting");
        
           if(photo_checkbox_for_deleting!=null&&photo_checkbox_for_deleting!="null"){
               if(photo_checkbox_for_deleting=='1'){
                   $("#User_photo_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#User_photo_checkbox_for_deleting").parent().prev();
                      name=$fileInput.attr('name');
                      id=$fileInput.attr('id');
                      classAttr=$fileInput.attr('class'); 
                      if(name==undefined){
                          name="";
                      }
                      if(id==undefined){
                          id="";
                      }
                      if(classAttr==undefined){
                          classAttr="";
                      }
                      $fileInput.replaceWith("<input type='file' name='"+name+"' id='"+id+"' class='"+classAttr+"'/>");
                      //
                      $node1=$("#User_photo_checkbox_for_deleting").parent().parent().prev();
                      $node1.remove();
                      $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_dummyman.jpg">').insertBefore($("#User_photo_checkbox_for_deleting").parent().parent().prev());                      
               }
               else{
                   $("#User_photo_checkbox_for_deleting").attr('checked',false);
               }
           }
        
       if(employee_number!=null&&employee_number!="null"){
           $("#User_employee_number").val(employee_number);
           
       }
       else{
           jQuery('#photo_error').remove();
       }
       if(role_id!=null&&role_id!="null"){
           $("#User_role_id").val(role_id);
       }
       if(mailaddr!=null&&mailaddr!="null"){
           $("#User_mailaddr").val(mailaddr);
       }
       if(lastname!=null&&lastname!="null"){
           $("#User_lastname").val(lastname);
       }
       if(firstname!=null&&firstname!="null"){
           $("#User_firstname").val(firstname);
       }
       
       
       if(birthday_year!=null&&birthday_year!="null"){
           $("#User_birthday_year").val(birthday_year);
       }
       if(birthday_month!=null&&birthday_month!="null"){
           $("#User_birthday_month").val(birthday_month);
       }
       if(birthday_day!=null&&birthday_day!="null"){
           $("#User_birthday_day").val(birthday_day);
       }
       if(joindate!=null&&joindate!="null"){
           $("#User_joindate").val(joindate);
       }
       
       
       
       if(comment!=null&&comment!="null"){     
		   comment1=comment.replace(/<br ?\/?>|_/g, '\n');	
           $("#User_comment").val(comment1);
       }
       chuc_vu=getCookie("user_edit_chuc_vu");
       if(chuc_vu!=null&&chuc_vu!="null"){
           $("#User_chuc_vu").val(chuc_vu);           
       }
       //begin 01/11/2013
	   if(division!=null&&division!="null"){
           $("#User_division").val(division);
           position=getCookie("user_edit_position");
           
           $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+division,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#User_position').html("");
                                     jQuery('#User_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#User_position').append("<option value='" + users[i].id+"'" +(users[i].id==position?' selected':'')+ ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+position,    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
       }
	    
	    
	   //end 
         
       
      
        var year = $("#User_birthday_year").val();
        var month = $("#User_birthday_month").val();
        if (
                month == 1
                || month == 3
                || month == 5
                || month == 7
                || month == 8
                || month == 10
                || month == 12
                ) {
            day(31);
        }
        else if (
                month == 4
                || month == 6
                || month == 9
                || month == 11
                ) {
            day(30);
        }
        else if (month == 2) {
            if (year % 4 == 0) {
                day(29);
            }
            else if (year % 4 != 0) {
                day(28);
            }
        }
        if(birthday_day!=null&&birthday_day!="null"){
               daySelected=birthday_day;
        }
        else{
            daySelected='<?php echo $model->birthday_day;?>';
        }
        
        
        options=$('#User_birthday_day option');
        for(i=1,n=options.length;i<=n;i++){
             if($(options[i]).attr('value')==daySelected){                
                 $(options[i]).attr('selected','selected');
                 break;
             }           
        }
        $("body").attr('id', 'admin');
        /**
         * 
         */
        
       
        /**
         * 
         */
        $("#User_birthday_month").change(function() {
            var year = $("#User_birthday_year").val();
            var month = $("#User_birthday_month").val();
            if (
                    month == 1
                    || month == 3
                    || month == 5
                    || month == 7
                    || month == 8
                    || month == 10
                    || month == 12
                    ) {
                day(31);
            }
            else if (
                    month == 4
                    || month == 6
                    || month == 9
                    || month == 11
                    ) {
                day(30);
            }
            else if (month == 2) {
                if (year % 4 == 0) {
                    day(29);
                }
                else if (year % 4 != 0) {
                    day(28);
                }
            }
        });
        $("#User_birthday_year").change(function() {
            var year = $("#User_birthday_year").val();
            var month = $("#User_birthday_month").val();
            if (
                    month == 1
                    || month == 3
                    || month == 5
                    || month == 7
                    || month == 8
                    || month == 10
                    || month == 12
                    ) {
                day(31);
            }
            else if (
                    month == 4
                    || month == 6
                    || month == 9
                    || month == 11
                    ) {
                day(30);
            }
            else if (month == 2) {
                if (year % 4 == 0) {
                    day(29);
                }
                else if (year % 4 != 0) {
                    day(28);
                }
            }


        });
        /**
         * 
         */
        $('button#next').click(function() {
          
            
		    deleteCookies("user_edit_from");    
                    
            $.ajax({
                type: "POST",
                async: true,
                url: "<?php echo Yii::app()->baseUrl; ?>/adminuser/edit/?id=<?php echo $model->id;?>",
                data: jQuery('#user_form').serialize(),
                success: function(msg) {
                    jQuery('#User_role_id').prev().remove();
                    jQuery('#User_employee_number').prev().remove();
                    jQuery('#User_mailaddr').prev().remove();
                    jQuery('#User_lastname').prev().remove();
                    jQuery('#User_lastname').prev().remove();
                    
                    jQuery('#User_joindate').prev().remove();
                    
                    jQuery('#User_comment').prev().remove();                    
                    jQuery("#error_message1").html("").removeClass("alert error_message");                    
                    jQuery('#photo_error').remove();

                    date=jQuery("#User_joindate").val();                            
                    if (msg != '[]'|(date!=""&&(date.length<4||date[0]=='0'))|checkFile()==false) {
                        data = $.parseJSON(msg);
                        if (data.User_role_id) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_role_id);
                            $(div).insertBefore($('#User_role_id'));

                        }
                        if (data.User_employee_number) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_employee_number);
                            $(div).insertBefore($('#User_employee_number'));
                        }
                        if (data.User_mailaddr) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_mailaddr);
                            $(div).insertBefore($('#User_mailaddr'));
                        }
                        if (data.User_lastname) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_lastname);
                            $(div).insertBefore($('#User_lastname'));
                        }
                        if (data.User_firstname) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_firstname);
                            $(div).insertBefore($('#User_lastname'));
                        }
                        if(data.User_lastname&&data.User_firstname){
                            $('#User_lastname').prev().remove();
                            $('#User_lastname').prev().remove();
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html("<?php echo Lang::MSG_0103;?>");
                            $(div).insertBefore($('#User_lastname'));
                        }
                        

                        
                        
                        if (data.User_joindate) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_joindate);
                            $(div).insertBefore($('#User_joindate'));
                        }
                        else{                            
                            if(date.length<4||date[0]=='0'){
                                div = document.createElement('div');
                                $(div).addClass('alert');
                                $(div).addClass('error_message');
                                $(div).html('<?php echo Lang::MSG_0023;?>');
                                $(div).insertBefore($('#User_joindate'));

                            }
                        }
                        if (data.User_division) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_division);
                            $(div).insertBefore($('#User_division'));
                        }
                        if (data.User_position) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_position);
                            $(div).insertBefore($('#User_position'));
                        }
                        if (data.User_comment) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_comment);
                            $(div).insertBefore($('#User_comment'));
                        }
                         $('body,html').animate({
                            scrollTop: 0
                        }, 500);

                    }
                    else {                                        
                        /**
                         * 
                         */
                        roleId = $("#User_role_id").val();
                        roleName = $("#User_role_id option[value='" + roleId + "']").html();
                        $("#User_role_name").val(roleName);
                        $("#User_birthday").val($("#User_birthday_year").val() + '/' + $("#User_birthday_month").val() + '/' + $("#User_birthday_day").val())
                       
                        /**
                         * 
                         */
                         jQuery('#user_form').attr('onsubmit','return true;')
                         setCookie("user_edit_employee_number",$("#User_employee_number").val());
                           setCookie("user_edit_role_id",$("#User_role_id").val());
                           setCookie("user_edit_mailaddr",$("#User_mailaddr").val());
                           setCookie("user_edit_lastname",$("#User_lastname").val());
                           setCookie("user_edit_firstname",$("#User_firstname").val());
                           
                           
                           setCookie("user_edit_birthday_year",$("#User_birthday_year").val());
                           setCookie("user_edit_birthday_month",$("#User_birthday_month").val());
                           setCookie("user_edit_birthday_day",$("#User_birthday_day").val());
                           setCookie("user_edit_joindate",$("#User_joindate").val());
                         
                           
						   setCookie("user_edit_division",$("#User_division").val());
						   setCookie("user_edit_position",$("#User_position").val());
                                                   setCookie("user_edit_chuc_vu",$("#User_chuc_vu").val());
																		     
						   
						   
						   
						   
						   //end                         
                           if($("#User_photo_checkbox_for_deleting").is(':checked')){
                                    setCookie("user_edit_photo_checkbox_for_deleting",'1');
                            }
                            else{
                                    setCookie("user_edit_photo_checkbox_for_deleting",'0');
                            }
                            
                           
                           val=$("#User_comment").val();
                            val=val.replace(/\n/g, "<br/>"); 
                            setCookie("user_edit_comment",val);
                        jQuery('#user_form').submit();
                    }
                }
            });
        });   
    });
	
	//end
</script>
<div class="wrapper secondary admin">

    
        <div class="contents detail">
<?php
$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"user","link"=>'/adminuser') ;        
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminuser/edit') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>            
            <div class="mainBox">
                <div class="pageTtl"><h2></h2>
              	    <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                    <span><a class="btn btn-important" href="<?php echo Yii::app()->baseUrl; ?>/adminuser/<?php echo $page;?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span></div>
                <div class="box">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'user_form',
                        'htmlOptions' => array(
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal',  
                            'onsubmit'=>'return false;'
                        ),
                    ));
                    ?>                
                              
                    
                    <?php echo $form->hiddenField($model, 'role_name'); ?>    
                    <?php echo $form->hiddenField($model, 'birthday'); ?>  
                    <?php echo $form->hiddenField($model, 'id'); ?>  
                   
                    
                    <input type="hidden" name="submit_active" value="1"/>                    
                    <input type="hidden" name="post_name" id="post_name"/>
                    

                    <div class="cnt-box">

                        <div class="baseDetailBox">
                            
                            <div class="textBox boxL mt15 clearfix">

                                <div class="control-group">
                                    <label class="control-label" for="staff_nmb">ID nhân viên&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'employee_number'); ?>
                                        <?php echo $form->textField($model, 'employee_number', array('class' => 'input-xlarge', 'placeholder' => 'Vui lòng nhập ID nhân viên。')); ?>                                                                        
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="affili_role">Phân quyền&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'role_id'); ?>
                                        <?php echo $form->dropDownList($model, 'role_id', $model->allRoles, array('options' => array($model->role_id => array('selected' => true)), 'class' => 'input-xlarge')); ?> 
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="mail">Email&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'mailaddr'); ?>
                                        <?php echo $form->textField($model, 'mailaddr', array('class' => 'input-xlarge', 'placeholder' => 'Vui lòng nhập email')); ?>                                    
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="user_name">Họ tên&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'lastname'); ?>
                                        <?php echo $form->error($model, 'firstname'); ?>
                                        <?php echo $form->textField($model, 'lastname', array('class' => 'input-small', 'placeholder' => 'Họ')); ?>                                    
                                        <?php echo $form->textField($model, 'firstname', array('class' => 'input-small', 'placeholder' => 'Tên')); ?>                                                                        
                                    </div>
                                </div>

                                
                                <div class="control-group">
                                    <label class="control-label" for="title">Ngày sinh&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">                                              
                                        <?php echo $form->dropDownList($model, 'birthday_year', $model->allBirthdayYear, array('options' => array($model->birthday_year => array('selected' => true)), 'class' => 'input-small', 'style'=>'width:76px;')); ?> 
                                        -
                                        <?php echo $form->dropDownList($model, 'birthday_month', $model->allBirthdayMonth, array('options' => array($model->birthday_month => array('selected' => true)), 'class' => 'input-mini', 'style'=>'width:76px;')); ?> 
                                        -
                                        <?php echo $form->dropDownList($model, 'birthday_day', $model->allBirthdayDay, array('options' => array($model->birthday_day => array('selected' => true)), 'class' => 'input-mini', 'style'=>'width:76px;')); ?>                          	                        	
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="joined_year">Năm tham gia&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'joindate'); ?>
                                        <?php echo $form->textField($model, 'joindate', array('class' => 'input-xlarge', 'placeholder' => 'Vui lòng nhập năm tham gia')); ?>                                                                        
                                    </div>
                                </div>
                            </div><!-- /boxL -->
                            <div class="textBox boxR clearfix">
                                <div class="building_photo">
                                	 <style>
											div.building_photo a{float:none !important;} 	
											a.a_base{float:none !important;}	
                                            img.img_base{ position:relative !important; float:none !important;}
                                        </style>
                                        <div id="error_message1"></div>
                                    <div></div>
                                    <?php
                                    $attachement4 = $this->beginWidget('ext.helpers.Form_new');								
                                    $attachement4->edit14($model, $form,'adminuser',$attachment4_error,Yii::app()->request->baseUrl);
                                    $this->endWidget();
                                    ?>   
                                </div>
                                
                            </div><!-- /boxR -->
							 <div class="clearfix" style="clear: both;">
                                
							
                            	<div class="units">    
                                    
                                    
                                    <div class="control-group">
                                        <label class="control-label" for="department1">Chi nhánh&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span>
                                        </label>
                                        <div class="controls">
                                              <?php 
											  	
													echo "<div id='error_message_division1'></div>";	
																								
												$array_unit = array();
												foreach ($unit as $unit_name){
													  
													   $array_unit[$unit_name['id']] = $unit_name['unit_name'];
													   
												}
												echo $form->dropDownList($model,'division',$array_unit,  array('prompt'=>'Chọn chi nhánh' , 'class' => 'input-xxlarge')); 											                                
												?> 											 
                                                                        	
                                        </div>
                                    </div>
        
                                    <div class="control-group">
                                        <label class="control-label" for="post1">Bộ phận&nbsp;
                                            <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span>
                                        </label>
                                        <div class="controls">
                                            <?php echo $form->dropDownList($model, 'position', $model->allPosts, array('options' => array($model->position => array('selected' => true)), 'class' => 'input-large')); ?> 
                  
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="post11">Chức vụ&nbsp;
                                            
                                        </label>
                                        <div class="controls">
                                            <?php echo $form->dropDownList($model, 'chuc_vu', $model->allChucVus, array('options' => array($model->chuc_vu => array('selected' => true)), 'class' => 'input-large')); ?> 
                   
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div><!-- /baseDetailBox -->

                        <div class="baseDetailBox">
                            
                            <div class="textBox mt15 clearfix">
                                

                                <div class="control-group">
                                    <label class="control-label" for="field_comment">Ghi chú&nbsp;</label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'comment'); ?>
                                        <?php echo $form->textarea($model, 'comment', array('placeholder' => 'Vui lòng nhập ghi chú', 'class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 2000)); ?>                            
                                    </div>
                                </div>
                            </div><!-- /textBox -->

                        </div><!-- /baseDetailBox -->



                    </div><!-- /cnt-box -->
                    <?php $this->endWidget(); ?>
                    <div class="form-last-btn">
                        <p class="btn80">
                            <button class="btn btn-important" type="submit" id="next"><i class="icon-chevron-right icon-white">&#12288;</i> <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_EDIT;?></button>
                        </p>
                    </div>

                   
                </div><!-- /box -->
            </div><!-- /mainBox -->

            <div class="sideBox">
                <ul>
                	<li>
                    	 <?php $this->widget('MenuManager');?>
                         <?php $this->widget('AffairsManage');?>
                         <?php $this->widget('SystemManage');?>
                         <?php $this->widget('PostedByContentManage');?>
                    </li>
                </ul>
            </div><!-- /sideBox -->

        </div><!-- /contents -->
        

</div>
