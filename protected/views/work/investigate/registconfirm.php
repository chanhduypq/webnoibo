<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/tab_cv.css" rel="stylesheet" media="screen"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary">

    
        <div class="contents confirm">
        	<?php
        	$home_link='/work';
        $link_array=array();
        $link_array[]=array("text"=>"Câu hỏi điều tra","link"=>'/workinvestigate') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/workinvestigate/regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>             
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2></div>
                <div class="box">
                <?php
				$form = $this->beginWidget('CActiveForm', array(
					'id' => 'investigate_form',    
					'htmlOptions' => array('enctype' => 'multipart/form-data','action'=>Yii::app()->baseUrl.'/workinvestigate/registconfirm'),
						));
				?> 
					<input type="hidden" name="file_index"/>
                    <div class="cnt-box">
                        <div class="form-horizontal">
                        	
<!--                            <div class="control-group">
                                <div class="control-label">Hoàn thành:</div>
                                <div class="controls">
                                    <p>
                                        <?php
//                                        $level_array=  Config_investigate::$level_array;
//                                        if(is_array($level_array)&&count($level_array)>0){
//                                            
//                                            foreach ($level_array as $key=>$value){
//                                                if($key==$model->icon){
//                                                    echo '<div class="n_group cl'.$key.'">'.$value.'</div>';
//                                                }
//                                            }
//                                        }                                    
                                    ?>
                                    </p>
                                </div>
                            </div>-->
                            <div class="control-group">
                                <div class="control-label"><?php echo Config::TEXT_FOR_LABEL_TITLE;?>:</div>
                                <div class="controls">
                                    <p><?php echo htmlspecialchars($model->title);?></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><?php echo Config::TEXT_FOR_LABEL_CONTENT;?></div>
                                <div class="controls">
                                    <p><?php echo nl2br(htmlspecialchars($model->content));?>	</p>
                                </div>
                            </div>
                        </div>                   
                        <div class="field attachements">
						  <?php $attachements = $this->beginWidget('ext.helpers.Form_new');?>
						  <?php $attachements->registConfirm11($model, $form,'workinvestigate',Yii::app()->request->baseUrl);?>
						  <?php $this->endWidget();?>
                	  </div>
                </div><!-- /cnt-box -->	
						<?php echo $form->hiddenField($model, 'id'); ?>  
                        
                        <?php echo $form->hiddenField($model, 'title'); ?>  
                        <?php echo $form->hiddenField($model, 'content'); ?> 
                <?php // echo $form->hiddenField($model, 'icon'); ?>  
                        <input type="hidden" name="regist" id="regist" value="1"/>
                        <?php $this->endWidget(); ?>         	
                <div class="form-last-btn">
                    <div class="btn170">
                        <button type="submit" class="btn" id="back"><i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button> 
                        <button class="btn btn-important" type="submit"  id="submit"><i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM;?></button>
                    </div>
                </div>

            </div><!-- /box -->
        </div><!-- /mainBox -->
            
        </div><!-- /contents -->
       

</div>
<script type="text/javascript">
    jQuery(function($) { 
        
        $("body").attr('id','work');          
        $(window).on('beforeunload', function(){
            setCookie("investigate_regist_from","confirm");            
        }); 
		
        setCookie("investigate_regist_title",$("#Investigate_title").val());
        setCookie("investigate_regist_content",$("#Investigate_content").val());
        setCookie("investigate_regist_attachment1_checkbox_for_deleting",$("#Investigate_attachment1_checkbox_for_deleting").val());
        setCookie("investigate_regist_attachment2_checkbox_for_deleting",$("#Investigate_attachment2_checkbox_for_deleting").val());
        setCookie("investigate_regist_attachment3_checkbox_for_deleting",$("#Investigate_attachment3_checkbox_for_deleting").val());
       
        $('button#submit').click(function(){  
            
            deleteCookies("investigate_regist_from");
            jQuery("input#regist").val('1');            
            jQuery("form#investigate_form").submit();
        });
        $('button#back').click(function(){  
		  	
            setCookie("investigate_regist_from","confirm");   
            window.location="<?php echo Yii::app()->baseUrl;?>/workinvestigate/regist/";
        });
       $('a').click(function(){  
            
            if($(this).attr('id')==undefined||$(this).attr('id')=='bttop'){
                return;
            }
            window.location="<?php echo Yii::app()->baseUrl;?>/workinvestigate/download/?file_name="+$(this).attr('id');
        });        
    });
</script>