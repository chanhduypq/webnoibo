<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary admin">

    
        <div class="contents detail">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Bộ phận","link"=>'/adminpost') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/adminpost/regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2>
                <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                <span><a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/adminpost/<?php echo $page;?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                </div>
                <div class="box">
                
                
					 <?php
                     $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'post_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',

                                          ),
                     ));
					?>	
                    
                    <div class="cnt-box">
                        <div class="baseDetailBox">
                            
                           
                                 
                           <div class="control-group">
                                        <label class="control-label" for="department1">Chi nhánh&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span>
                                        </label>
                                        <div class="controls">
                                              <?php 
											  	
													
																								
												$array_unit = array();
												foreach ($unit as $unit_name){
													  
													   $array_unit[$unit_name['id']] = $unit_name['unit_name'];
													   
												}
												echo $form->dropDownList($model,'unit_id',$array_unit,  array('prompt'=>'Chọn chi nhánh' , 'class' => 'input-xxlarge')); 											                                
												?> 											 
                                                                        	
                                        </div>
                                    </div>

                            <div class="control-group">
                                <label class="control-label" for="name">Tên bộ phận&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                <div class="controls">
                                     <?php echo $form->error($model, 'post_name'); ?>
                    	             <?php echo $form->textField($model, 'post_name', array('class' => 'input-xlarge')); ?>
                                </div>
                            </div>
                                
                            
                           
                                
                            
                            
                        </div><!-- /baseDetailBox -->
                        <div class="field attachements">
                                 <?php                    
									$attachements = $this->beginWidget('ext.helpers.Form_new');								

                                                        $attachements->regist11($model, $form,$attachment1_error,$attachment2_error,$attachment3_error,'adminpost',Yii::app()->request->baseUrl);
							$this->endWidget();
                           		 ?>
                                 
                                </div><!-- /attachements -->
					</div><!-- /cnt-box -->
                
 					<?php $this->endWidget(); ?>
                    <div class="form-last-btn">
                        <p class="btn80">
                            <button type="submit" class="btn btn-important"><i class="icon-chevron-right icon-white">　</i> <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_REGIST;?></button>
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
        
</div><!-- /wrap -->
<script type="text/javascript"> 
       
        jQuery(function($){
            $('a').click(function(){ 


            
            
             
            if($(this).attr('id')==undefined||$(this).attr('id')=='bttop'){
                return;
            }
            window.location="<?php echo Yii::app()->baseUrl;?>/adminpost/download/?file_name="+$(this).attr('id');
        });
            
         $('input[type="checkbox"]').click (function (){  
             
                 if ($(this).is (':checked')){ 
                      $fileInput=$(this).parent().parent().prev().find('input[type="file"]').eq(0);
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
                      $node1=$(this).parent().parent().prev().prev();
                      $node1.remove();
                      $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($(this).parent().parent().prev());                      
                 }
            }); 
            
         $("#post_form").attr('action','<?php echo Yii::app()->baseUrl;?>/adminpost/registconfirm/');        
            
			//check back browser 
		   
		   
		   
		   post_name=getCookie("post_regist_post_name");
		   if(post_name!=null&&post_name!="null"){
			   $("#Post_post_name").val(post_name);
		   }
                   else{
               jQuery('#err1').remove();
               jQuery('#err2').remove();
               jQuery('#err3').remove();
               
               
           }
           unit_id=getCookie("post_regist_unit_id");
           if(unit_id!=null&&unit_id!="null"){
           $("#Post_unit_id").val(unit_id);
       }
           
          
          
  
          
		   
			
		    attachment1_checkbox_for_deleting=getCookie("post_regist_attachment1_checkbox_for_deleting");
           if(attachment1_checkbox_for_deleting!=null&&attachment1_checkbox_for_deleting!="null"){              
               if(attachment1_checkbox_for_deleting=='1'){
                   $("#Post_attachment1_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Post_attachment1_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Post_attachment1_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Post_attachment1_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Post_attachment1_checkbox_for_deleting").attr('checked',false);
               }
              
           }
           attachment2_checkbox_for_deleting=getCookie("post_regist_attachment2_checkbox_for_deleting");
           if(attachment2_checkbox_for_deleting!=null&&attachment2_checkbox_for_deleting!="null"){
               if(attachment2_checkbox_for_deleting=='1'){
                   $("#Post_attachment2_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Post_attachment2_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Post_attachment2_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Post_attachment2_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Post_attachment2_checkbox_for_deleting").attr('checked',false);
               }
           }
           attachment3_checkbox_for_deleting=getCookie("post_regist_attachment3_checkbox_for_deleting");
           if(attachment3_checkbox_for_deleting!=null&&attachment3_checkbox_for_deleting!="null"){
               if(attachment3_checkbox_for_deleting=='1'){
                   $("#Post_attachment3_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Post_attachment3_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Post_attachment3_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Post_attachment3_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Post_attachment3_checkbox_for_deleting").attr('checked',false);
               }
           
             
           }
          
		   
           $("body").attr('id','admin');    
           
           $('button[type="submit"]').click(function(){ 
               
           
            deleteCookies("post_regist_from");
			
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminpost/regist/",    
				data: jQuery('#post_form').serialize(),
				success: function(msg)
				{	     
					 
					 
					 
                      jQuery('#Post_post_name').prev().remove();    
                      jQuery('#Post_unit_id').prev().remove();    
                      
					  jQuery("#error_message1").html("").removeClass("alert error_message");                    
					  jQuery('#photo_error').remove();
					 
					  	if(msg!='[]'|checkFile()==false)
					    {
                                                
							data=$.parseJSON(msg);
							
				if (data.Post_post_name) {
                                div = document.createElement('div');
                                $(div).addClass('alert');
                                $(div).addClass('error_message');
                                $(div).html(data.Post_post_name);
                                $(div).insertBefore($('#Post_post_name'));
                            }	
                            if (data.Post_unit_id) {
                                div = document.createElement('div');
                                $(div).addClass('alert');
                                $(div).addClass('error_message');
                                $(div).html(data.Post_unit_id);
                                $(div).insertBefore($('#Post_unit_id'));
                            }	
							
                            
                            
					  }							  															
					  else
					  {   
					   	  
						   
                           setCookie("post_regist_post_name",$("#Post_post_name").val());
                           setCookie("post_regist_unit_id",$("#Post_unit_id").val());
                           
                           
						   
						   
                                                               
							if($("#Post_attachment1_checkbox_for_deleting").is(':checked')){
                                                           
								setCookie("post_regist_attachment1_checkbox_for_deleting",'1');
							}
							else{
								setCookie("post_regist_attachment1_checkbox_for_deleting",'0');
							}
							if($("#Post_attachment2_checkbox_for_deleting").is(':checked')){
								setCookie("post_regist_attachment2_checkbox_for_deleting",'1');
							}
							else{
								setCookie("post_regist_attachment2_checkbox_for_deleting",'0');
							}
							if($("#Post_attachment3_checkbox_for_deleting").is(':checked')){
								setCookie("post_regist_attachment3_checkbox_for_deleting",'1');
							}
							else{
								setCookie("post_regist_attachment3_checkbox_for_deleting",'0');
							}
                                                        
							
						jQuery('#post_form').submit();					  
					 }					    			    
				 }	  
			});
			
		});    
   });   
function checkFile(){
	
    var result	 = true;
    $("#error_message1").html("");
    $("#error_message1").removeClass("cerrorMessage alert error_message");
    $("#error_message2").html("");
    $("#error_message2").removeClass("cerrorMessage alert error_message");
    $("#error_message3").html("");
    $("#error_message3").removeClass("cerrorMessage alert error_message");
    $(".error_message").html("");

    $("div").removeClass("cerrorMessage alert error_message");
    var checkBox1  = jQuery('#Post_attachment1_checkbox_for_deleting').is(":checked");
    var checkBox2  = jQuery('#Post_attachment2_checkbox_for_deleting').is(":checked");
    var checkBox3  = jQuery('#Post_attachment3_checkbox_for_deleting').is(":checked");


    //check format file
    var arr_file	   = [".zip", ".doc", ".docx", ".xls" , ".xlsx" , ".ppt" , ".pptx" , ".pdf" , ".rar" , ".jpg" , ".gif", ".png", ".jpeg"];			
    var arr_file1	   = [".jpg" , ".gif", ".png", ".jpeg"];			
    var attachment1 = jQuery('#Post_attachment1').val();

    checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
    checkFile1	   = checkFile1.toLowerCase();

    var attachment2 = jQuery('#Post_attachment2').val();
    checkFile2	   = attachment2.substr(attachment2.lastIndexOf('.'));
    checkFile2	   = checkFile2.toLowerCase();

    var attachment3 = jQuery('#Post_attachment3').val();

    checkFile3	   = attachment3.substr(attachment3.lastIndexOf('.'));
    checkFile3	   = checkFile3.toLowerCase();
    
   
    file1			   = jQuery.inArray(checkFile1, arr_file);
    file2			   = jQuery.inArray(checkFile2, arr_file);
    file3			   = jQuery.inArray(checkFile3, arr_file);
   

    if(checkBox1 == false && file1 == -1 && attachment1 !="")
    {
               jQuery("#error_message1").html("<?php echo Lang::MSG_0036 ?>");	
               jQuery("#error_message1").addClass("cerrorMessage alert error_message");
               result = false;

    }
  
    if(checkBox2 == false && file2 == -1 && attachment2 !="")
    {
               jQuery("#error_message2").html("<?php echo Lang::MSG_0037 ?>");	
               jQuery("#error_message2").addClass("cerrorMessage alert error_message");
               result = false;

    }
    if(checkBox3 == false && file3 == -1 && attachment3 !="")
    {
               jQuery("#error_message3").html("<?php echo Lang::MSG_0038 ?>");	
               jQuery("#error_message3").addClass("cerrorMessage alert error_message");
               result = false;

    }
    
    return result;
}   
</script>
