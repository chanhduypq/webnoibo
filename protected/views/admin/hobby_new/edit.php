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
        $link_array[]=array("text"=>"Tin tức","link"=>'/adminhobby_new') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminhobby_new/edit') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>   
            <div class="mainBox detail">
            	<div class="pageTtl">
				<h2></h2>
					<span>
						<?php if(Yii::app()->request->cookies['page'] != NULL): ?>	
						  <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhobby_new/index?page=<?php echo Yii::app()->request->cookies['page']?>" class="btn btn-important">
								<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						  </a>
						<?php else : ?>
						  <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhobby_new" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						  </a>
						<?php endif; ?>
					</span>
                </div>
                <div class="box">
                <?php $form = $this->beginWidget('CActiveForm', array(
					'id' => 'hobby_new_edit',                     
					'htmlOptions' => array(
										  'enctype' => 'multipart/form-data',
										  'class'=>'form-horizontal',                                          
										  ),));?>

				<?php echo $form->hiddenField($model, 'id'); ?>  
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
					<?php $attachements = $this->beginWidget('ext.helpers.Form_new');
							  $attachements->edit_one_file_img($model, $form,'adminhobby_new',$attachment1_error,Yii::app()->request->baseUrl);                        
							  $this->endWidget();?>
					</div>
                    
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                <div class="form-last-btn">
					<p class="btn80">
						<button type="submit" class="btn btn-important">
						  <i class="icon-chevron-right icon-white">　</i><?php echo Config::TEXT_FOR_NEXT_IN_PAGE_EDIT;?>
						</button>
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

	
	//Method using check id hobby_new
	function checkId(id)
	{
		$.ajax({   
			type: "POST", 
			async:true,
			url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_new/checkId/",    
			data:{id:id},
			success: function(msg)
			{	        
				if(msg=='0')
				{ 
					window.location.href="<?php echo Yii::app()->baseUrl;?>/adminhobby_new/index";
				}
			}
		});
	}
	
	function checkFile()
	{
		var result	 = true;
		$("#error_message1").html("");
		$("#error_message1").removeClass("cerrorMessage alert error_message");
		
		$(".error_message").html("");
		$("div").removeClass("cerrorMessage alert error_message");
		var checkBox1  = jQuery('#Hobby_new_attachment1_checkbox_for_deleting').is(":checked");
		

		//check format file
		var arr_file	   = [ ".jpg" , ".gif", ".png", ".jpeg"];			
		var attachment1 = jQuery('#Hobby_new_attachment1').val();

		checkFile1	   = attachment1.substr(attachment1.lastIndexOf('.'));
		checkFile1	   = checkFile1.toLowerCase();

		

		file1			   = jQuery.inArray(checkFile1, arr_file);
		
		if(checkBox1 == false && file1 == -1 && attachment1 !="")
		{
		   jQuery("#error_message1").html("<?php echo Lang::MSG_0036 ?>");	
		   jQuery("#error_message1").addClass("cerrorMessage alert error_message");
		   result = false;

		}
		
		return result;
	}

	jQuery(function($)
	{   
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
	    $("body").attr('id','admin');
 
	    $("#hobby_new_edit").attr('action', '<?php echo Yii::app()->baseUrl; ?>/adminhobby_new/editconfirm/');  
		 
	    title=getCookie("hobby_new_edit_title");
		if(title!=null && title!="null")
		{
			$("#Hobby_new_title").val(title);
		}
                else{
                   jQuery('#err1').remove();
                   
                   
               }
		
		content=getCookie("hobby_new_edit_content");
		if(content!=null && content!="null")
		{
			content1=content.replace(/<br\s*\/?>/mg,"\n");
			$("#Hobby_new_content").val(content1);
		}
		
		attachment1_checkbox_for_deleting=getCookie("hobby_new_edit_attachment1_checkbox_for_deleting");
	    if(attachment1_checkbox_for_deleting!=null&&attachment1_checkbox_for_deleting!="null")
	    {              
		   if(attachment1_checkbox_for_deleting=='1')
		   {
			   $("#Hobby_new_attachment1_checkbox_for_deleting").attr('checked',true);
                           $fileInput=$("#Hobby_new_attachment1_checkbox_for_deleting").parent().parent().prev().find('input[type="file"]').eq(0);
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
                  $node1=$("#Hobby_new_attachment1_checkbox_for_deleting").parent().parent().prev().prev();
                  $node1.remove();
                  $('<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.jpg">').insertBefore($("#Hobby_new_attachment1_checkbox_for_deleting").parent().parent().prev());
		   }
		   else
		   {
			   $("#Hobby_new_attachment1_checkbox_for_deleting").attr('checked',false);
		   }
	    }
		
        

		
	   $('button[type="submit"]').click(function()
	   {    

		   deleteCookies("hobby_new_edit_form"); 
		   
		   
		   
		   
		   var id = $('#Hobby_new_id').val();	
		   checkId(id);
			
			$.ajax
			({    
					type: "POST", 
					async:true,
					url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_new/edit/?id=<?php echo $model->id;?>",    
					data: jQuery('#hobby_new_edit').serialize(),
					success: function(msg)
					{	            
					    jQuery('#Hobby_new_title').prev().remove();                                       						                                            					  	
					    jQuery('#Hobby_new_content').prev().remove(); 	
						if(msg!='[]' | !checkFile())
						{
							data=$.parseJSON(msg);
							if(data.Hobby_new_title)
							{	
								div=document.createElement('div');
								$(div).addClass('alert');
								$(div).addClass('error_message');
								$(div).html(data.Hobby_new_title);
								$(div).insertBefore($('#Hobby_new_title')); 
							} 
							if(data.Hobby_new_content)
						    {
								div=document.createElement('div');
								$(div).addClass('alert');
								$(div).addClass('error_message');
								$(div).html(data.Hobby_new_content);
								$(div).insertBefore($('#Hobby_new_content')); 
							} 	 
					}		
					else
					{
					  
						setCookie("hobby_new_edit_title",$("#Hobby_new_title").val());
                        val=$("#Hobby_new_content").val();
						val=val.replace(/\n/g, "<br/>");
                        setCookie("hobby_new_edit_content",val);
					
						if($("#Hobby_new_attachment1_checkbox_for_deleting").attr('checked')==true)
						{
                            setCookie("hobby_new_edit_attachment1_checkbox_for_deleting",'1');
                        }
						else
						{
							setCookie("hobby_new_edit_attachment1_checkbox_for_deleting",'0');
						}

						
						
						jQuery('#hobby_new_edit').submit();
					}
				}	  
			});
		
		});
 
    });	
       	
</script>