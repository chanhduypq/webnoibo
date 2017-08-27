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
        $link_array[]=array("text"=>"Chi nhánh","link"=>'/adminunit') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/adminunit/regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2>
                <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                <span><a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/adminunit/<?php echo $page;?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                </div>
                <div class="box">
                
                
					 <?php
                     $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'unit_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',

                                          ),
                     ));
					?>	
                    
                    <div class="cnt-box">
                        <div class="baseDetailBox">
                            
                           
                                 
                           

                            <div class="control-group">
                                <label class="control-label" for="name">Tên chi nhánh&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                <div class="controls">
                                     <?php echo $form->error($model, 'unit_name'); ?>
                    	             <?php echo $form->textField($model, 'unit_name', array('class' => 'input-xlarge')); ?>
                                </div>
                            </div>
                                
                            <div class="control-group">
                                <label class="control-label" for="mail">Email</label>
                                <div class="controls">
                                    
                                     <?php echo $form->error($model, 'mailaddr'); ?>
                    	             <?php echo $form->textField($model, 'mailaddr', array('class' => 'input-xxlarge')); ?>
                                </div>
                            </div>
                            <div class="control-group">
	                                <label class="control-label" for="introduceTtl">Khẩu hiệu&nbsp;</label>
	                                <div class="controls">
                                         <?php echo $form->error($model, 'catchphrase'); ?>
                    	                 <?php echo $form->textField($model, 'catchphrase', array('class' => 'input-xxlarge')); ?>
	                                </div>
	                            </div>
                                <div class="control-group">
                                   <label class="control-label" for="introduceTxt">Giới thiệu&nbsp;</label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'introduction'); ?>
                        	            <?php echo $form->textarea($model, 'introduction', array('class' => 'input-xxlarge', 'rows' => 7, 'maxlength' => 2000)); ?> 
                                    </div>
                                </div>
                            
                            
                        </div><!-- /baseDetailBox -->
                        <div class="field attachements">
                                 <?php                    
									$attachements = $this->beginWidget('ext.helpers.Form_new');								

                                                        $attachements->regist11($model, $form,$attachment1_error,$attachment2_error,$attachment3_error,'adminunit',Yii::app()->request->baseUrl);
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
            window.location="<?php echo Yii::app()->baseUrl;?>/adminunit/download/?file_name="+$(this).attr('id');
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
            
         $("#unit_form").attr('action','<?php echo Yii::app()->baseUrl;?>/adminunit/registconfirm/');        
            
			//check back browser 
		   
		   
		   
		   unit_name=getCookie("unit_regist_unit_name");
		   if(unit_name!=null&&unit_name!="null"){
			   $("#Unit_unit_name").val(unit_name);
		   }
                   else{
               jQuery('#err1').remove();
               jQuery('#err2').remove();
               jQuery('#err3').remove();
               
               
           }	    
           
           unit_mailaddr=getCookie("unit_regist_mailaddr");
           if(unit_mailaddr!=null&&unit_mailaddr!="null")
		   {
               $("#Unit_mailaddr").val(unit_mailaddr);
           }
          
  
           unit_catchphrase=getCookie("unit_regist_catchphrase");
           if(unit_catchphrase!=null&&unit_catchphrase!="null"){
               $("#Unit_catchphrase").val(unit_catchphrase);
           }
		    unit_introduction=getCookie("unit_regist_introduction");           
           if(unit_introduction!=null&&unit_introduction!="null"){
				
			   introduction1=unit_introduction.replace(/<br ?\/?>|_/g, '\n');	
               $("#Unit_introduction").val(introduction1);
           }
			
		    attachment1_checkbox_for_deleting=getCookie("unit_regist_attachment1_checkbox_for_deleting");
           if(attachment1_checkbox_for_deleting!=null&&attachment1_checkbox_for_deleting!="null"){              
               if(attachment1_checkbox_for_deleting=='1'){
                   $("#Unit_attachment1_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Unit_attachment1_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Unit_attachment1_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Unit_attachment1_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Unit_attachment1_checkbox_for_deleting").attr('checked',false);
               }
              
           }
           attachment2_checkbox_for_deleting=getCookie("unit_regist_attachment2_checkbox_for_deleting");
           if(attachment2_checkbox_for_deleting!=null&&attachment2_checkbox_for_deleting!="null"){
               if(attachment2_checkbox_for_deleting=='1'){
                   $("#Unit_attachment2_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Unit_attachment2_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Unit_attachment2_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Unit_attachment2_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Unit_attachment2_checkbox_for_deleting").attr('checked',false);
               }
           }
           attachment3_checkbox_for_deleting=getCookie("unit_regist_attachment3_checkbox_for_deleting");
           if(attachment3_checkbox_for_deleting!=null&&attachment3_checkbox_for_deleting!="null"){
               if(attachment3_checkbox_for_deleting=='1'){
                   $("#Unit_attachment3_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Unit_attachment3_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Unit_attachment3_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Unit_attachment3_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Unit_attachment3_checkbox_for_deleting").attr('checked',false);
               }
           
             
           }
          
		   
           $("body").attr('id','admin');    
           
           $('button[type="submit"]').click(function(){ 
               
           
            deleteCookies("unit_regist_from");
			
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminunit/regist/",    
				data: jQuery('#unit_form').serialize(),
				success: function(msg)
				{	     
					 
					 
					 
                      jQuery('#Unit_unit_name').prev().remove();    
                      jQuery('#Unit_mailaddr').prev().remove();  
					  jQuery("#error_message1").html("").removeClass("alert error_message");                    
					  jQuery('#photo_error').remove();
					 
					  	if(msg!='[]'|checkFile()==false)
					    {
							data=$.parseJSON(msg);
							
				if (data.Unit_unit_name) {
                                div = document.createElement('div');
                                $(div).addClass('alert');
                                $(div).addClass('error_message');
                                $(div).html(data.Unit_unit_name);
                                $(div).insertBefore($('#Unit_unit_name'));
                            }			
							
                            if (data.Unit_mailaddr) {
                                div = document.createElement('div');
                                $(div).addClass('alert');
                                $(div).addClass('error_message');
                                $(div).html(data.Unit_mailaddr);
                                $(div).insertBefore($('#Unit_mailaddr'));
                            }
                            
					  }							  															
					  else
					  {   
					   	  
						   
                           setCookie("unit_regist_unit_name",$("#Unit_unit_name").val());
                           setCookie("unit_regist_mailaddr",$("#Unit_mailaddr").val());
                           
						   setCookie("unit_regist_catchphrase",$("#Unit_catchphrase").val());
						   val=$("#Unit_introduction").val();
						   val=val.replace(/\n/g, "<br/>");
						   setCookie("unit_regist_introduction",val);
                                                               
							if($("#Unit_attachment1_checkbox_for_deleting").is(':checked')){
                                                           
								setCookie("unit_regist_attachment1_checkbox_for_deleting",'1');
							}
							else{
								setCookie("unit_regist_attachment1_checkbox_for_deleting",'0');
							}
							if($("#Unit_attachment2_checkbox_for_deleting").is(':checked')){
								setCookie("unit_regist_attachment2_checkbox_for_deleting",'1');
							}
							else{
								setCookie("unit_regist_attachment2_checkbox_for_deleting",'0');
							}
							if($("#Unit_attachment3_checkbox_for_deleting").is(':checked')){
								setCookie("unit_regist_attachment3_checkbox_for_deleting",'1');
							}
							else{
								setCookie("unit_regist_attachment3_checkbox_for_deleting",'0');
							}
                                                        
							
						jQuery('#unit_form').submit();					  
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
    var checkBox1  = jQuery('#Unit_attachment1_checkbox_for_deleting').is(":checked");
    var checkBox2  = jQuery('#Unit_attachment2_checkbox_for_deleting').is(":checked");
    var checkBox3  = jQuery('#Unit_attachment3_checkbox_for_deleting').is(":checked");


    //check format file
    var arr_file	   = [".zip", ".doc", ".docx", ".xls" , ".xlsx" , ".ppt" , ".pptx" , ".pdf" , ".rar" , ".jpg" , ".gif", ".png", ".jpeg"];			
    var arr_file1	   = [".jpg" , ".gif", ".png", ".jpeg"];			
    var attachment1 = jQuery('#Unit_attachment1').val();

    checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
    checkFile1	   = checkFile1.toLowerCase();

    var attachment2 = jQuery('#Unit_attachment2').val();
    checkFile2	   = attachment2.substr(attachment2.lastIndexOf('.'));
    checkFile2	   = checkFile2.toLowerCase();

    var attachment3 = jQuery('#Unit_attachment3').val();

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
