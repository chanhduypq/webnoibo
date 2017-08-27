<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary admin">
    
        <div class="contents edit">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Các văn bản & quyết định","link"=>'/admincriticism') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/admincriticism/edit') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2>
                <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                <span><a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/admincriticism/<?php echo $page;?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                </div>
                <div class="box">
                <?php
                
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'criticism_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                          
                                          ),
                        ));
                    
                ?> 
                <?php echo $form->hiddenField($model, 'id'); ?>                    
                <div class="cnt-box">
                    
                    <div class="control-group">
                        <label for="title" class="control-label"><?php echo Config::TEXT_FOR_LABEL_TITLE;?>&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	<?php echo $form->error($model, 'title'); ?>
                        	<?php echo $form->textField($model, 'title', array('placeholder' => Config::TEXT_FOR_PLACEHOLDER_TITLE, 'class' => 'input-xxlarge')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="content" class="control-label"><?php echo Config::TEXT_FOR_LABEL_CONTENT;?>&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	<?php echo $form->error($model, 'content'); ?>
                        	<?php echo $form->textarea($model, 'content', array('placeholder' => Config::TEXT_FOR_PLACEHOLDER_CONTENT, 'class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 3000)); ?>                            
                        </div>
                    </div>
                    
                  <div class="field attachements">
                        <?php                    
                        $attachements = $this->beginWidget('ext.helpers.Form_new');
                        $attachements->edit11($model, $form,'admincriticism',$attachment1_error,$attachment2_error,$attachment3_error,Yii::app()->request->baseUrl);
                        $this->endWidget();
                        ?>

                  </div>
                    
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                <div class="form-last-btn">                    
                	<p class="btn80">
	                    <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">&#12288;</i> <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_EDIT;?></button>
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
            </div>
            
        </div><!-- /contents -->
        

</div>

<script type="text/javascript">       
    

function checkId()
{
        jQuery.ajax({   
        type: "POST", 
                async:true,
                url: "<?php echo Yii::app()->baseUrl;?>/admincriticism/checkId/",    
                data:{id:"<?php echo $model->id;?>",table:"criticism"},
                success: function(msg){	
            
                        
                        if(msg=='0'){ 
                                window.location='<?php echo Yii::app()->baseUrl;?>/admincriticism';
                        }
                }
        });
}
    
        jQuery(function($){ 
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
           $("#criticism_form").attr('action', '<?php echo Yii::app()->baseUrl; ?>/admincriticism/editconfirm/');   
		   
		   
		                    
           title=getCookie("criticism_edit_title");
           if(title!=null&&title!="null"){
               $("#Criticism_title").val(title);
           }
           else{
               jQuery('#err1').remove();
               jQuery('#err2').remove();
               jQuery('#err3').remove();
            
           }
           content=getCookie("criticism_edit_content");
           if(content!=null&&content!="null"){
              content1=content.replace(/<br ?\/?>|_/g, '\n');    
               $("#Criticism_content").val(content1);
           }   
           attachment1_checkbox_for_deleting=getCookie("criticism_edit_attachment1_checkbox_for_deleting");
           if(attachment1_checkbox_for_deleting!=null&&attachment1_checkbox_for_deleting!="null"){              
               if(attachment1_checkbox_for_deleting=='1'){
                   $("#Criticism_attachment1_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Criticism_attachment1_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Criticism_attachment1_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Criticism_attachment1_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Criticism_attachment1_checkbox_for_deleting").attr('checked',false);
               }
               
           }
           attachment2_checkbox_for_deleting=getCookie("criticism_edit_attachment2_checkbox_for_deleting");
           if(attachment2_checkbox_for_deleting!=null&&attachment2_checkbox_for_deleting!="null"){
               if(attachment2_checkbox_for_deleting=='1'){
                   $("#Criticism_attachment2_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Criticism_attachment2_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Criticism_attachment2_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Criticism_attachment2_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Criticism_attachment2_checkbox_for_deleting").attr('checked',false);
               }
           
              
           }
           attachment3_checkbox_for_deleting=getCookie("criticism_edit_attachment3_checkbox_for_deleting");
           if(attachment3_checkbox_for_deleting!=null&&attachment3_checkbox_for_deleting!="null"){
               if(attachment3_checkbox_for_deleting=='1'){
                   $("#Criticism_attachment3_checkbox_for_deleting").attr('checked',true);
                   $fileInput=$("#Criticism_attachment3_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Criticism_attachment3_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Criticism_attachment3_checkbox_for_deleting").parent().parent().prev());
               }
               else{
                   $("#Criticism_attachment3_checkbox_for_deleting").attr('checked',false);
               }
           
              
           }
           setCookie("criticism_edit_title",$("#Criticism_title").val());
           setCookie("criticism_edit_content",content);

           $("body").attr('id','admin');     
           $('button[type="submit"]').click(function(){  
            no=2;            
            deleteCookies("criticism_edit_from");  
            checkId();
			$.ajax({ 
                			
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/admincriticism/edit/?id=<?php echo $model->id;?>",    
				data: jQuery('#criticism_form').serialize(),


				success: function(msg){	                        
					  jQuery('#Criticism_title').prev().remove();                                       					                					
					  jQuery('#Criticism_content').prev().remove();                                       					
					  	if(msg!='[]'|checkFile()==false){
                                                    data=$.parseJSON(msg);
													 
                                                    if(data.Criticism_title){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Criticism_title);
                                                         $(div).insertBefore($('#Criticism_title'));
                                                         
                                                    } 
                                                    if(data.Criticism_content){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Criticism_content);
                                                         $(div).insertBefore($('#Criticism_content'));
                                                         
                                                    } 
					  	}							  															
					else{   
											
                                            setCookie("criticism_edit_title",$("#Criticism_title").val());
                                            val=$("#Criticism_content").val();
                                            val=val.replace(/\n/g, "<br/>");
                                            setCookie("criticism_edit_content",val);
                                            if($("#Criticism_attachment1_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("criticism_edit_attachment1_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("criticism_edit_attachment1_checkbox_for_deleting",'0');
                                                }
                                                if($("#Criticism_attachment2_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("criticism_edit_attachment2_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("criticism_edit_attachment2_checkbox_for_deleting",'0');
                                                }
                                                if($("#Criticism_attachment3_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("criticism_edit_attachment3_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("criticism_edit_attachment3_checkbox_for_deleting",'0');
                                                }
                                            jQuery('#criticism_form').submit();
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
    var checkBox1  = jQuery('#Criticism_attachment1_checkbox_for_deleting').is(":checked");
    var checkBox2  = jQuery('#Criticism_attachment2_checkbox_for_deleting').is(":checked");
    var checkBox3  = jQuery('#Criticism_attachment3_checkbox_for_deleting').is(":checked");

    //check format file
    var arr_file	   = [".zip", ".doc", ".docx", ".xls" , ".xlsx" , ".ppt" , ".pptx" , ".pdf" , ".rar" , ".jpg" , ".gif", ".png", ".jpeg"];			
    var attachment1 = jQuery('#Criticism_attachment1').val();

    checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
    checkFile1	   = checkFile1.toLowerCase();

    var attachment2 = jQuery('#Criticism_attachment2').val();
    checkFile2	   = attachment2.substr(attachment2.lastIndexOf('.'));
    checkFile2	   = checkFile2.toLowerCase();

    var attachment3 = jQuery('#Criticism_attachment3').val();

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
