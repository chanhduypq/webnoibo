<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary admin"> 

   
        <div class="contents confirm">
            <?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Đọc ngay nhé","link"=>'/adminnews_cv') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminnews_cv/editconfirm') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 

            <div class="mainBox detail">
                <div class="pageTtl"><h2></h2></div>

                <div class="box">
                        <?php
						$form = $this->beginWidget('CActiveForm', array(
							'id' => 'news_cv_form',
							'htmlOptions' => array('enctype' => 'multipart/form-data', 'action' => Yii::app()->baseUrl . '/adminnews_cv/editconfirm'),
								));
						?>
						<input type="hidden" name="file_index"/>
						<?php echo $form->hiddenField($model, 'id'); ?>   
                        <?php echo $form->hiddenField($model, 'created_date'); ?> 
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
                            <?php                    
                            $attachements = $this->beginWidget('ext.helpers.Form_new');
                            $attachements->editConfirm11($model, $form,'adminnews_cv',Yii::app()->request->baseUrl);
                            $this->endWidget();
                            ?>
                        </div>
                    </div><!-- /cnt-box -->	
                    
					<?php echo $form->hiddenField($model, 'title'); ?>  
                    <?php echo $form->hiddenField($model, 'content'); ?>  
                    <input type="hidden" name="edit" id="edit" value="1"/>    
<?php $this->endWidget(); ?>                                      
                    <div class="form-last-btn">
                        <div class="btn170">
                            <button type="submit" class="btn" id="back"><i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button>                                    
                            <button class="btn btn-important" id="submit" type="submit"><i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM;?></button>
                        </div>
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
    jQuery(function($) {  
        
        $(window).on('beforeunload', function(){
            setCookie("news_cv_edit_from","confirm");            
        }); 
        $('button#submit').click(function(){  
            deleteCookies("news_cv_edit_from");
            jQuery("input#edit").val('1');            
            jQuery("form#news_cv_form").submit();
        });
        $('button#back').click(function(){ 
            setCookie("news_cv_edit_from","confirm");   
            window.location="<?php echo Yii::app()->baseUrl;?>/adminnews_cv/edit/?id=<?php echo $model->id;?>";
        });
        $('a').click(function(){  
            if($(this).attr('id')==undefined||$(this).attr('id')=='bttop'){
                return;
            }
			 window.location="<?php echo Yii::app()->baseUrl;?>/adminnews_cv/download/?file_name="+$(this).attr('id');
        });
       
	    
        setCookie("news_cv_edit_title",$("#News_cv_title").val());
        setCookie("news_cv_edit_content",$("#News_cv_content").val());
        setCookie("news_cv_edit_attachment1_checkbox_for_deleting",$("#News_cv_attachment1_checkbox_for_deleting").val());
        setCookie("news_cv_edit_attachment2_checkbox_for_deleting",$("#News_cv_attachment2_checkbox_for_deleting").val());
        setCookie("news_cv_edit_attachment3_checkbox_for_deleting",$("#News_cv_attachment3_checkbox_for_deleting").val());        
        $("body").attr('id','admin');         
    });
</script>