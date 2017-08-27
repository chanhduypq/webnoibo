<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script type="text/javascript">


    jQuery(function($) {
       
        $("body").attr('id', 'admin');
        /**
         * 
         */
        $('button#next').click(function() {
		   
                    
            $.ajax({
                type: "POST",
                async: true,
                url: "<?php echo Yii::app()->baseUrl; ?>/adminprofile/edit/?id=<?php echo $model->id;?>",
                data: jQuery('#user_form').serialize(),
                success: function(msg) {                    
                    jQuery('#User_employee_number').prev().remove();
                    jQuery('#User_passwd').prev().remove();
                    jQuery('#User_catchphrase').prev().remove();
                    jQuery('#User_comment').prev().remove();                    
                    jQuery("#error_message1").html("").removeClass("alert error_message");                    
                    jQuery('div.errorMessage ').remove();
                                     
                    if (msg != '[]') {
                        data = $.parseJSON(msg);
                        
                        if (data.User_passwd) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_passwd);
                            $(div).insertBefore($('#User_passwd'));
                        }
                        if (data.User_catchphrase) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_catchphrase);
                            $(div).insertBefore($('#User_catchphrase'));
                        }
                        if (data.User_comment) {
                            div = document.createElement('div');
                            $(div).addClass('alert');
                            $(div).addClass('error_message');
                            $(div).html(data.User_comment);
                            $(div).insertBefore($('#User_comment'));
                        }
                        $('body,html').animate({
                            scrollTop: 0
                        }, 500);
                    }
                    else {                                        
                        
                        if(confirm('Bạn có chắc thay đổi không?')){
                            jQuery('#user_form').submit();
                        }
                        
                    }
                }
            });
        });


        
    });
</script>
<div class="wrap admin secondary user">

    
        <div class="contents detail">

            <div class="mainBox">
                <div class="pageTtl"><h2></h2>
                    <span>
                     <?php
					if(isset(Yii::app()->request->cookies['passwd'])&&Yii::app()->request->cookies['passwd']->value=='smile@gmorunsystem'){
					?>	
					<script type='text/javascript'>
					 $(document).ready(function(){
						$("a#back_profile").attr("href", "<?php echo Yii::app()->baseUrl;?>/adminprofile/detail/?id=<?php echo $model->id;?>");
						});
					</script>
					<?php		
					}
					?>
                    <a id="back_profile" class="btn btn-important" href="<?php echo Yii::app()->baseUrl;?>/adminprofile/detail/?id=<?php echo $model->id;?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></a></span></div>
                <div class="box">
                    
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'user_form',
                        'htmlOptions' => array(
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-horizontal',  
                           
                        ),
                    ));
                    ?>                
                              
                    
                    <?php echo $form->hiddenField($model, 'role_name'); ?>    
                    <?php echo $form->hiddenField($model, 'id'); ?>    

                    <div class="cnt-box">

                        <div class="baseDetailBox">
                            
                            <div class="textBox boxL mt15 clearfix">

                                <div class="field staff_nmb">
                                    <div class="title">ID nhân viên&nbsp;</div>
                                    <div class="data"><p><?php echo $model->employee_number;?><?php echo $form->hiddenField($model, 'employee_number'); ?>  </p></div>
                                </div>
                                <div class="control-group">
                                    <label for="staff_pw" class="control-label">password&nbsp;
                                    <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($model, 'passwd'); ?>
                                        <?php echo $form->passwordField($model, 'passwd', array('class' => 'input-xlarge', 'placeholder' => '変更する場合は入力してください。')); ?>                                                                            
                                    </div>
                                </div>

                                <div class="field last_name">
                                    <div class="title">Email&nbsp;</div>
                                    <div class="data"><?php echo $model->mailaddr;?><?php echo $form->hiddenField($model, 'mailaddr'); ?>							 </div>
                                </div>

                                <div class="field last_name">
                                    <div class="title">Họ tên&nbsp;</div>
                                    <div class="data"><?php echo $model->lastname.' '.$model->firstname;?><?php echo $form->hiddenField($model, 'firstname'); ?> <?php echo $form->hiddenField($model, 'lastname'); ?></div>
                                </div>
                                
                                <div class="field birth_day">
                                    <div class="title">Ngày sinh&nbsp;</div>
                                    <div class="data">
									<?php echo convertDateFromDbToView($model->birthday); ?><?php echo $form->hiddenField($model, 'birthday'); ?> </div>
                                </div>
                                <div class="field joined_year">
                                    <div class="title">Năm tham gia&nbsp;</div>
                                    <div class="data"><?php echo $model->joindate;?><?php echo $form->hiddenField($model, 'joindate'); ?> </div>
                                </div>
                                <div class="field joined_year">
                                    <div class="title">Chi nhánh&nbsp;</div>
                                    <div class="data">
                                        <?php 
                                        foreach($unit as $units){
											if($model->division==$units['id']){
												echo "<span class='unit'>".$units['unit_name']."</span>";
												
												
												 
											}
										 }
                                        ?> 
                                    </div>
                                </div>
                                <div class="field joined_year">
                                    <div class="title">Bộ phận&nbsp;</div>
                                    <div class="data">
                                        <?php 
                                        
												
												
												foreach($post as $post_name){
													if($model->position==$post_name['id']){
														echo '<span class="post">'.$post_name['post_name'].' </span>';
													}
												 }
												 
											
										 
                                        ?> 
                                    </div>
                                </div>
                                <div class="field joined_year">
                                    <div class="title">Chức vụ&nbsp;</div>
                                    <div class="data">
                                        <?php  
                                        $position_array=  Config_position_user::$position_array;
                                        if(is_array($position_array)&&count($position_array)>0){
                                            foreach($position_array as $key=>$value){
                                                    if($model->chuc_vu==$key){
                                                            echo $value;
                                                    }
                                             }
                                        }
										
								?>
                                    </div>
                                </div>

                            </div><!-- /boxL -->
							
                            <div class="textBox boxR clearfix">
                                <div class="building_photo">
                                    <?php
									
                                    $photo=Yii::app()->db->createCommand("select photo from user where id=".$model->id)->queryScalar();
                                    if($photo==FALSE){
                                        $photo='';
                                    }
                                    if (trim($photo) != ""&&file_exists(Yii::getPathOfAlias('webroot').$photo)) {//have file
                                        $thumnail_file_path=  FunctionCommon::getFilenameInThumnail($model->photo);
                                        ?>
                                    
                                        <a style="width:228px; margin: 0px 15px;" href="<?php echo Yii::app()->request->baseUrl.$model->photo;?>" rel="prettyPhoto">
                                                <img style="height:171px;" src="<?php echo Yii::app()->request->baseUrl.$thumnail_file_path;?>"/>
                                        </a>
                                    
                                    <?php
                                        
                                    } else {//do not have file?>
                                        <img style="width:228px; margin: 0px 15px;" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_dummyman.jpg">
                                    <?php    
                                    }                                    
                                    ?> 
                                    
                                    
                                </div>
                            </div><!-- /boxR -->
                            
                        </div><!-- /baseDetailBox -->
						
                        

                        <div class="baseDetailBox">
                            
                            <div class="textBox mt15 clearfix">
                               
                                <div class="field1 joined_year">
                                    <div class="title">Ghi chú&nbsp;</div>
                                    <div class="data">
                                        <p><?php echo nl2br(htmlspecialchars($model->comment));?></p>
                                    </div>
                                </div>

                                
                            </div><!-- /textBox -->

                        </div><!-- /baseDetailBox -->



                    </div><!-- /cnt-box -->
                    <?php $this->endWidget(); ?>
                    <div class="form-last-btn">
                        <p class="btn80">
                         <?php
						if(isset(Yii::app()->request->cookies['passwd'])&&Yii::app()->request->cookies['passwd']->value=='smile@gmorunsystem'){
						?>	
						<script type='text/javascript'>
						 $(document).ready(function(){
							$('button#next').attr('type','submit');
							});
						</script>
						<?php		
						}
						?>
                            <button class="btn btn-important" type="submit" id="next"><i class="icon-refresh icon-white"></i> Edit</button>
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
        

</div>
<?php

function convertDateFromDbToView($datetime) {
    if ($datetime == NULL || !is_string($datetime) || trim($datetime) == "") {
        return $datetime;
    }
    $date_time_array = explode(" ", $datetime);
    $date = $date_time_array[0];
    $y_m_d_array = explode("-", $date);
    return implode("/", $y_m_d_array);
}
?>