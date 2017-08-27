<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/role.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/json.js"></script>
<div class="wrapper secondary admin role">

   
        <div class="contents index">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Phân quyền","link"=>'/adminrole') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/admincoffee/edit') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2>
                <span><a href="<?php echo Yii::app()->baseUrl.'/adminrole/'?>" class="btn btn-important"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                </div>
                <div class="box">
                <?php $form = $this->beginWidget('CActiveForm', array(
						'id' => 'edit_role_form', 
                        'action'=>Yii::app()->baseUrl.'/adminrole/edit_confirm',
                        'htmlOptions' => array(
						'enctype' => 'multipart/form-data',
						'class'=>'form-horizontal',
						'onsubmit'=>'return false;',
                        ),));?>
                <div class="cnt-box">
                  
                	<div class="control-group">
                        <label class="control-label" for="title">Quyền&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                            <?php echo $form->error($role_model, 'role_name'); ?>
                            <?php echo $form->textField($role_model,'role_name',array('class'=>"input-xlarge",'id'=>'txtRoleName','placeholder'=>"Vui lòng nhập quyền","autofocus"))?>
                            <?php echo $form->hiddenField($role_model,'id')?>
   
                        </div>
                    </div>
                     <?php
                            $i = 0;
                            foreach ($functions as $function) {
                                $i++;
                                $checkView="";
                                $checkPost="";
                                $checkAdmin="";
                                
                               foreach($role_management as $role){
                                    if($function->id==$role->function_id && $role->baserole_id==Constants::$baserole['view']){
                                        $checkView="checked";
                                    }
                                    if($function->id==$role->function_id && $role->baserole_id==Constants::$baserole['post']){
                                        $checkPost="checked";
                                    }
                                    if($function->id==$role->function_id && $role->baserole_id==Constants::$baserole['admin']){
                                        $checkAdmin="checked";
                                    }
                                }
                                ?>
                                <input name="Role_management[<?php echo $i ?>][function_id]" value="<?php echo $function->id ?>"  type="hidden"/>
                                <div class="control-group">
                                    <label class="control-label"
                                           for="inputEmail"><?php echo htmlspecialchars($function->function_name)?></label>

                                    <div class="controls">
                                        <div>
                                            <?php
                                           
                                            if($function->function_name=="user"                                               
                                               ||$function->function_name=="Phân quyền"
                                               ||$function->function_name=="Chi nhánh"
                                               ||$function->function_name=="Bộ phận"     
                                            ){?>
                                               <label class="checkbox inline"><input name="Role_management[<?php echo $i ?>][chkview]" type="checkbox" id="chbview_<?php echo $i ?>" disabled="disabled" <?php echo $checkView ?> />
											   <div class="view_role">Xem</div></label>
                                            <?php     }
                                             else { ?>
                                               <label class="checkbox inline"><input name="Role_management[<?php echo $i ?>][chkview]" type="checkbox" id="chbview_<?php echo $i ?>" <?php echo $checkView ?> />
											   <div class="view_role">Xem</div></label>
                                            <?php    } ?>
                                            <?php
                                           
                                            if($function->function_name=="Xem bói"
                                               ||$function->function_name=="user"
                                               ||$function->function_name=="Châm ngôn"
                                               ||$function->function_name=="Phân quyền"
                                               ||$function->function_name=="Chi nhánh"
                                               ||$function->function_name=="Bộ phận"     
                                            ){?>
                                            <label class="checkbox inline"><input name="Role_management[<?php echo $i ?>][chkpost]"
                                                                                  name="" type="checkbox" id="chbpost_<?php echo $i ?>" disabled="disabled" <?php echo $checkPost ?>/><div class="post_role">Đăng tin</div></label>                                                
                                            <?php     }
                                            else { ?>
                                                 <label class="checkbox inline"><input name="Role_management[<?php echo $i ?>][chkpost]"
                                                                                  name="" type="checkbox" id="chbpost_<?php echo $i ?>" <?php echo $checkPost ?>/><div class="post_role">Đăng tin</div></label>
                                            <?php    
                                            }?>
                                              <?php
                                           
                                            if($function->function_name=="Xem bói"                                               
                                               ||$function->function_name=="Châm ngôn"                                               
                                            ){?>
                                            
                                            <label class="checkbox inline"><input
                                                    name="Role_management[<?php echo $i ?>][chkadmin]" type="checkbox" id="chbadmin_<?php echo $i ?>" disabled="disabled" <?php echo $checkAdmin ?>/><div class="control_role">Quản trị</div></label>
                                            <?php }
                                            else{?>
                                                 <label class="checkbox inline"><input
                                                    name="Role_management[<?php echo $i ?>][chkadmin]" type="checkbox" id="chbadmin_<?php echo $i ?>" <?php echo $checkAdmin ?>/><div class="control_role">Quản trị</div></label>
                                         
                                            <?php    
                                            }    
                                            ?>          
                                     </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                    
                  
                    
                </div><!-- /cnt-box -->
                
                <div class="form-last-btn">
                	<p class="btn80">
	                    <button type="submit" class="btn btn-important"><i class="icon-chevron-right icon-white">　</i><?php echo Config::TEXT_FOR_NEXT_IN_PAGE_EDIT;?></button>
                    </p>
                </div>
                
                <?php $this->endWidget(); ?>
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
       

</div><!-- /wrap -->
    

</body>
</html>
<script>
var submit=false;
$(window).load(function(){
   var roleName=getCookie('rolename');
   var arrCheck=getCookie('checkdata');
   if(roleName && roleName!="null"){
        $("#txtRoleName").val(roleName);
   }
   if(arrCheck)
   {
        var item=$.parseJSON(arrCheck);
        $.each(item, function(index){
           if(item[index]["1"]==1){
            $("input#chbview_"+item[index]["id"]).attr('checked','checked');
           } 
           if(item[index]["2"]==1){
            $("input#chbpost_"+item[index]["id"]).attr('checked','checked');
           } 
           if(item[index]["3"]==1){
            $("input#chbadmin_"+item[index]["id"]).attr('checked','checked');
           } 
        });
    }
   
    
});
$('button[type="submit"]').click(function(){
    submit=true;
    jQuery('#txtRoleName').prev().remove();
    $.ajax({    
    				type: "POST", 
    				async:false,
    				url: "<?php echo Yii::app()->baseUrl;?>/index.php/adminrole/edit/?id=<?php echo $role_model->id;?>",    
    				data: jQuery('#edit_role_form').serialize(),
                	success: function(msg){	                        
    					 jQuery('#txtRoleName').prev().remove();
                          if(msg!='[]'){
                                        data=JSON.parse(msg);
                                        if(data.Role_role_name){
                                             div=document.createElement('div');
                                             $(div).addClass('alert');
                                             $(div).addClass('error_message');
                                             $(div).html(data.Role_role_name);
                                             $(div).insertBefore($('#txtRoleName'));
                                             
                                        } 
                                        $('html, body').animate({ scrollTop: 0 }, 'slow');                
                                        submit=false;                
    						  
    					  	}							  															
    					
    											    			    
    				}	  
    			});
                if( !validateCheckBox()){
                     div=document.createElement('div');
                     $(div).addClass('alert');
                     $(div).addClass('error_message');
                     $(div).html("<?php echo Lang::MSG_0066 ?>");
                     $(div).insertBefore($('#txtRoleName'));
                     $('html, body').animate({ scrollTop: 0 }, 'slow');  
                            
                     submit=false;                   
                }
               if(submit){
                    jQuery('#edit_role_form').attr('onsubmit','return true;');
                    jQuery('#edit_role_form').submit();
                    setCookie("rolename",$("#txtRoleName").val(),1);
                    setCookie("checkdata",getCheckboxData(),1);
                    
               }
               
              
    					  	
    			
        
    });
   

</script>
