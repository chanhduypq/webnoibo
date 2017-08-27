<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary">
    
        <div class="contents regist">    
<?php
        	$home_link='/work';
        $link_array=array();
        $link_array[]=array("text"=>"Đọc ngay nhé","link"=>'/worknews_cv') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/worknews_cv/regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>             
            <div class="mainBox detail">
            	<div class="pageTtl">
                    <h2></h2>
                    <span>
						 <?php 
                        if(Yii::app()->request->cookies['page']!= NULL) 
                        {
                               $page = "index?page=".Yii::app()->request->cookies['page']->value;
                                
                        }else {$page ="";}
                        ?>
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/worknews_cv/<?php echo $page;?>">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'news_cv_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                         
                                          ),
                        ));
                ?>                   
                <div class="cnt-box">     
					
                    <div class="control-group">
                        <label class="control-label" for="title"><?php echo Config::TEXT_FOR_LABEL_TITLE;?>&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	
                        	<?php echo $form->textField($model, 'title', array('placeholder' => Config::TEXT_FOR_PLACEHOLDER_TITLE, 'class' => 'input-xxlarge')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="content"><?php echo Config::TEXT_FOR_LABEL_CONTENT;?>&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	
                        	<?php echo $form->textarea($model, 'content', array('placeholder' => Config::TEXT_FOR_PLACEHOLDER_CONTENT, 'class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 3000)); ?>
                        </div>
                    </div>
                    <div class="field attachements">
                       
                        <?php                 
                        $attachements = $this->beginWidget('ext.helpers.Form_new');
						$attachements->regist11($model, $form,$attachment1_error,$attachment2_error,$attachment3_error,'worknews_cv',Yii::app()->request->baseUrl);
                        $this->endWidget();
                    ?>
                      </div>
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                    <div class="form-last-btn">
                        <p class="btn80">
                            <button class="btn btn-important" type="submit">
								<i class="icon-chevron-right icon-white">&#12288;</i> <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_REGIST;?>
							</button>
                        </p>
                        
                    </div> 
                
                </div><!-- /box -->
            </div><!-- /mainBox -->
            
        </div><!-- /contents -->
        

</div>
<script type="text/javascript"> 

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
          $("#news_cv_form").attr('action','<?php echo Yii::app()->baseUrl;?>/worknews_cv/registconfirm/');       	   
		 
		      
           title=getCookie("news_cv_regist_title");
           if(title!=null&&title!="null"){
               $("#News_cv_title").val(title);
           }
		   else{
               jQuery('#err1').remove();
               jQuery('#err2').remove();
               jQuery('#err3').remove();
               
           }
           content=getCookie("news_cv_regist_content");           
           if(content!=null&&content!="null"){
                content1=content.replace(/<br ?\/?>|_/g, '\n');
               $("#News_cv_content").val(content1);
           }
           attachment1_checkbox_for_deleting=getCookie("news_cv_regist_attachment1_checkbox_for_deleting");
           if(attachment1_checkbox_for_deleting!=null&&attachment1_checkbox_for_deleting!="null"){              
               if(attachment1_checkbox_for_deleting=='1'){
                   $("#News_cv_attachment1_checkbox_for_deleting").attr('checked',true);
               }
               else{
                   $("#News_cv_attachment1_checkbox_for_deleting").attr('checked',false);
               }
              
           }
           attachment2_checkbox_for_deleting=getCookie("news_cv_regist_attachment2_checkbox_for_deleting");
           if(attachment2_checkbox_for_deleting!=null&&attachment2_checkbox_for_deleting!="null"){
               if(attachment2_checkbox_for_deleting=='1'){
                   $("#News_cv_attachment2_checkbox_for_deleting").attr('checked',true);
               }
               else{
                   $("#News_cv_attachment2_checkbox_for_deleting").attr('checked',false);
               }
           
            
           }
           attachment3_checkbox_for_deleting=getCookie("news_cv_regist_attachment3_checkbox_for_deleting");
           if(attachment3_checkbox_for_deleting!=null&&attachment3_checkbox_for_deleting!="null"){
               if(attachment3_checkbox_for_deleting=='1'){
                   $("#News_cv_attachment3_checkbox_for_deleting").attr('checked',true);
               }
               else{
                   $("#News_cv_attachment3_checkbox_for_deleting").attr('checked',false);
               }
           }
		   
		  
           setCookie("news_cv_regist_title",$("#News_cv_title").val());
           setCookie("news_cv_regist_content",content); 
           $('a').click(function(){ 


            
            
             
            if($(this).attr('id')==undefined||$(this).attr('id')=='bttop'){
                return;
            }
            window.location="<?php echo Yii::app()->baseUrl;?>/worknews_cv/download/?file_name="+$(this).attr('id');
        });
            /**
             * 
             */
           $("body").attr('id','work');      
        
           $('button[type="submit"]').click(function(){  
    
            deleteCookies("news_cv_regist_from"); 		   
			$.ajax({    
				type: "POST", 
				async:true,
                                data: jQuery('#news_cv_form').serialize(),
				url: "<?php echo Yii::app()->baseUrl;?>/worknews_cv/regist/",   
				success: function(msg){	          
					  	
					  jQuery('#News_cv_title').prev().remove();                                       				                  					
					  jQuery('#News_cv_content').prev().remove();                                       						                                            					  	
					  	if(msg!='[]'|checkFile()==false){
                                                    data=$.parseJSON(msg);
													
													
                                                    if(data.News_cv_title){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.News_cv_title);
                                                         $(div).insertBefore($('#News_cv_title'));
                                                         
                                                    } 
                                                    if(data.News_cv_content){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.News_cv_content);
                                                         $(div).insertBefore($('#News_cv_content'));                                                         
                                                    }
                                                }							  															
					else{                               
												 
												
                                                setCookie("news_cv_regist_title",$("#News_cv_title").val());
                                                
                                                val=$("#News_cv_content").val();
                                                val=val.replace(/\n/g, "<br/>");
                                                setCookie("news_cv_regist_content",val);
                                                if($("#News_cv_attachment1_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("news_cv_regist_attachment1_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("news_cv_regist_attachment1_checkbox_for_deleting",'0');
                                                }
                                                if($("#News_cv_attachment2_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("news_cv_regist_attachment2_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("news_cv_regist_attachment2_checkbox_for_deleting",'0');
                                                }
                                                if($("#News_cv_attachment3_checkbox_for_deleting").attr('checked')==true){
                                                    setCookie("news_cv_regist_attachment3_checkbox_for_deleting",'1');
                                                }
                                                else{
                                                    setCookie("news_cv_regist_attachment3_checkbox_for_deleting",'0');
                                                }
                                                jQuery('#news_cv_form').submit();
                                            
                                            
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
    var checkBox1  = jQuery('#News_cv_attachment1_checkbox_for_deleting').is(":checked");
    var checkBox2  = jQuery('#News_cv_attachment2_checkbox_for_deleting').is(":checked");
    var checkBox3  = jQuery('#News_cv_attachment3_checkbox_for_deleting').is(":checked");

    //check format file
    var arr_file	   = [".zip", ".doc", ".docx", ".xls" , ".xlsx" , ".ppt" , ".pptx" , ".pdf" , ".rar" , ".jpg" , ".gif", ".png", ".jpeg"];			
    var attachment1 = jQuery('#News_cv_attachment1').val();

    checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
    checkFile1	   = checkFile1.toLowerCase();

    var attachment2 = jQuery('#News_cv_attachment2').val();
    checkFile2	   = attachment2.substr(attachment2.lastIndexOf('.'));
    checkFile2	   = checkFile2.toLowerCase();

    var attachment3 = jQuery('#News_cv_attachment3').val();

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