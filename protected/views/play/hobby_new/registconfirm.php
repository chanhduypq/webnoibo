<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary">

    
        <div class="contents confirm">
        	<?php
        $home_link='/play';
        $link_array=array();
        $link_array[]=array("text"=>"Tin tức","link"=>'/playhobby_new') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/playhobby_new/registconfirm') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>            
            <div class="mainBox detail">
            	<div class="pageTtl">
					<h2></h2>
				</div>
                <div class="box">
				<?php $form = $this->beginWidget('CActiveForm', array(
					  'id' => 'newitem_registconfirm',    
					  'htmlOptions' => array('enctype' => 'multipart/form-data'),));?>
				<input type="hidden" name="file_index"/>
				<input type="hidden" name="regist" id="regist" value="1"/>
				<?php echo $form->hiddenField($model, 'id'); ?>  				
				<?php echo $form->hiddenField($model, 'title'); ?>  
				<?php echo $form->hiddenField($model, 'content'); ?>  
                <div class="cnt-box">
                    <div class="form-horizontal">
                        
                        
                        <div class="control-group">
                            <div class="control-label"><?php echo Config::TEXT_FOR_LABEL_TITLE;?>:</div>
                            <div class="controls">
                                <p>
									<?php echo htmlspecialchars($model->title);?>
								</p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <div class="control-label"><?php echo Config::TEXT_FOR_LABEL_CONTENT;?></div>
                            <div class="controls">
                                <p>
									<?php echo nl2br(htmlspecialchars($model->content));?>
								</p>
                            </div>
                        </div>
                        
                    </div>
					<div class="field attachements">
                      <?php $attachements = $this->beginWidget('ext.helpers.Form_new');?>
                      <?php $attachements->regist_confirm_one_file_img($model, $form,'playhobby_new',Yii::app()->request->baseUrl);?>
                      <?php $this->endWidget();?>
                    </div>	
                </div><!-- /cnt-box -->	
                             <?php $this->endWidget(); ?> 
				<div class="form-last-btn">
					<div class="btn170">
						<button type="submit" class="btn" id="back">
							<i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?>
						</button>
						<button class="btn btn-important" id="submit" type="submit">
							<i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM;?>
						</button>
					</div>
				</div>
   

                </div><!-- /box -->
            </div><!-- /mainBox -->
            
            
        </div><!-- /contents -->
        

   

</div>
<!-- /wrap -->
<script type="text/javascript">

	
	jQuery(function($) 
	{
		$("body").attr('id','work'); 
		no=1;
		function getUrl(no)
		{
            return "<?php echo Yii::app()->baseUrl;?>/common/deletecookie/?no="+no;
        }
		
		$(window).on('beforeunload', function()
		{
			setCookie("hobby_new_regist_form","confirm");            
			// $.ajax
			// ({    
				// type: "GET", 
				// async:false,
				// url: getUrl(no)
			// });
		});

		
		setCookie("hobby_new_reg_content",$("#Hobby_new_content").val());
        setCookie("hobby_new_reg_attachment1_checkbox_for_deleting",$("#Hobby_new_attachment1_checkbox_for_deleting").val());
        	
		
		$('button#submit').click(function()
		{  
            no=2;
            deleteCookies("hobby_new_regist_form");
            jQuery("input#regist").val('1');            
            jQuery("form#newitem_registconfirm").submit();
        });
		
		$('button#back').click(function()
		{  
            setCookie("hobby_new_regist_form","confirm");   
            
            window.location="<?php echo Yii::app()->baseUrl;?>/playhobby_new/regist";
        });
		
		
        
	});

</script>