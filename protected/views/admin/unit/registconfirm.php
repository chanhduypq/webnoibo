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
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/adminunit/registconfirm') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2></div>
                <div class="box">
                
                	 
                	 <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'unit_form',
                        'htmlOptions' => array('enctype' => 'multipart/form-data', 'action' => Yii::app()->baseUrl . '/adminunit/registconfirm'),
                    ));
                    ?>
                  
                    <?php echo $form->hiddenField($model, 'last_updated_person', array('value' => 'last_updated_person')); ?>
                    <input type="hidden" name="regist" id="regist" value="1"/>
                    <input type="hidden" name="file_index"/>
                    
                    <?php echo $form->hiddenField($model, 'id'); ?>  
                    
                    <?php echo $form->hiddenField($model, 'unit_name'); ?>  
                    <?php echo $form->hiddenField($model, 'mailaddr'); ?>
                   
                    <?php echo $form->hiddenField($model, 'catchphrase'); ?>
                    <?php echo $form->hiddenField($model, 'introduction'); ?>  
                      
                    <div class="cnt-box">
                    	<div class="baseDetailBox form-horizontal">
                            

	                        

	                        <div class="control-group">
	                            <div class="control-label">Tên chi nhánh</div>
	                            <div class="controls">
                                        <p><?php echo $model->unit_name; ?></p>
	                            </div>
	                        </div>
                            
	                        <div class="control-group">
	                            <div class="control-label">Email</div>
	                            <div class="controls">
	                                <p><?php echo $model->mailaddr; ?></p>
	                            </div>
	                        </div>
                            <div class="control-group">
	                            <div class="control-label">Khẩu hiệu</div>
	                            <div class="controls">
                                        <p><?php echo $model->catchphrase; ?></p>
	                            </div>
	                        </div>
                            
	                        <div class="control-group">
	                            <div class="control-label">Giới thiệu</div>
	                            <div class="controls">
	                                <p><?php echo nl2br(FunctionCommon::url_henkan($model->introduction)); ?></p>
	                            </div>
	                        </div>

	                        
                            

                        </div><!-- /baseDetailBox -->
                        <div class="field attachements">
                                 <?php                    
									$attachements = $this->beginWidget('ext.helpers.Form_new');									
                                    $attachements->registConfirm11($model, $form,'adminunit',Yii::app()->request->baseUrl);
									$this->endWidget();
                           		 ?>
                                 
                                </div><!-- /attachements -->
					</div><!-- /cnt-box -->
                    
                    
                    
					<?php $this->endWidget(); ?>  
                    <div class="form-last-btn">
                        <div class="btn170">
                            <button type="submit" class="btn" id="back"><i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button>
                            <button type="submit" class="btn btn-important" id="submit"><i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM;?></button>
                        </div>
                    </div>
                
              </div><!-- /box -->
            </div><!-- /mainBox -->
            
            <div class="sideBox">
                <ul>
                    <li>
                        <?php $this->widget('MenuManager'); ?>
                        <?php $this->widget('AffairsManage'); ?>
                        <?php $this->widget('SystemManage'); ?>
<?php $this->widget('PostedByContentManage'); ?>
                    </li>
                </ul>
            </div><!-- /sideBox -->
            
  </div><!-- /contents -->
       

</div><!-- /wrap -->
<script type="text/javascript">
    jQuery(function($) {
        
       
        $("body").attr('id', 'admin');
        $(window).on('beforeunload', function() {
            setCookie("unit_regist_from", "confirm");
            
        });
		
		
        $('button#submit').click(function() {
            
            jQuery("input#regist").val('1');
            jQuery("form#unit_form").submit();
        });
        $('button#back').click(function() {
           
            setCookie("unit_regist_from", "confirm");

             window.location="<?php echo Yii::app()->baseUrl;?>/adminunit/regist";
        });
        $('a').click(function() {
            
            if ($(this).attr('id') == undefined||$(this).attr('id')=='bttop') {
                return;
            }
            window.location = "<?php echo Yii::app()->baseUrl; ?>/adminunit/download/?file_name=" + $(this).attr('id');
        });
    });
</script>
<?php
function echoEmpty($has_img = FALSE) {
    if ($has_img === true) {
        echo '<img alt="" src="' . Yii::app()->baseUrl . '/css/common/img/img_photo01.jpg">';
    } else {
        echo '';
    }
}
?>