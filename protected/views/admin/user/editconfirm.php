<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script type="text/javascript">
    jQuery(function($) {
       
        
        $(window).on('beforeunload', function(){
            setCookie("user_edit_from","confirm");             
        }); 

        $('button#submit').click(function(){  
            
           
            jQuery("input#edit").val('1');            
            jQuery("form#user_form").submit();
        });
        $('button#back').click(function(){  
            
            setCookie("user_edit_from","confirm");   
            
            window.location="<?php echo Yii::app()->baseUrl;?>/adminuser/edit/?id=<?php echo $model->id;?>";
        });
        $('a').click(function(){  
            
            
            if($(this).attr('id')==undefined||$(this).attr('id')=='bttop'){
                return;
            }
            window.location="<?php echo Yii::app()->baseUrl;?>/adminuser/download/?file_name="+$(this).attr('id');
        });
    
        $("body").attr('id', 'admin');
        
       
       
        <?php if (isset($invalid) && $invalid == true) { ?>
                    $(window).load(function() {
                        jQuery('#user_form').attr('onsubmit','return true;')
                            $("#user_form").attr('action', '<?php echo Yii::app()->baseUrl; ?>/adminuser/edit/');                   
                            $("#user_form").submit();

                        
                    });
        <?php } ?>
    });
</script>
<div class="wrapper secondary admin">

    
        <div class="contents detail">
<?php
$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"user","link"=>'/adminuser') ;        
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminuser/editconfirm') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>            
            <div class="mainBox">
                <div class="pageTtl"><h2></h2></div>
                <div class="box">
                    <div class="cnt-box">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'user_form',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data',
                                'class' => 'form-horizontal',
                            ),
                        ));
                        ?>   
                        <?php echo $form->hiddenField($model, 'id'); ?>  
                        <?php echo $form->hiddenField($model, 'role_id'); ?>   
                        <?php echo $form->hiddenField($model, 'employee_number'); ?>   
                        <?php echo $form->hiddenField($model, 'passwd'); ?>   
                        <?php echo $form->hiddenField($model, 'mailaddr'); ?>   
                        <?php echo $form->hiddenField($model, 'lastname'); ?>   
                        <?php echo $form->hiddenField($model, 'firstname'); ?>                           
                        <?php echo $form->hiddenField($model, 'birthday_year'); ?>   
                        <?php echo $form->hiddenField($model, 'birthday_month'); ?>   
                        <?php echo $form->hiddenField($model, 'birthday_day'); ?>   
                        <?php echo $form->hiddenField($model, 'joindate'); ?>                    
                        
                        
                        <?php echo $form->hiddenField($model, 'comment'); ?>                      
                        <?php echo $form->hiddenField($model, 'role_name');
                        echo $form->hiddenField($model, 'photo_checkbox_for_deleting');
                        echo $form->hiddenField($model, 'division'); 
                        echo $form->hiddenField($model, 'position'); 
                        echo $form->hiddenField($model, 'chuc_vu'); 
                        
                        ?> 
        				
                        <input type="hidden" name="edit" id="edit" value="1"/>
                        <input type="hidden" name="submit_active" value="1"/>
                        <div class="baseDetailBox">
                            
                            <div class="textBox boxL mt15 clearfix">
                                <div class="field staff_nmb">
                                    <div class="title">Id nhân viên&nbsp;</div>
                                    <div class="data">
										<p>
										<?php echo htmlspecialchars($model->employee_number); ?>
										</p>
									</div>
                                </div>

                                <div class="field affili_post">
                                    <div class="title">Quyền&nbsp;</div>
                                    <div class="data">
									<?php echo $model->role_name; ?>
									</div>
                                </div>

                                <div class="field mail">
                                    <div class="title">Email&nbsp;</div>
                                    <div class="data">
										<?php echo htmlspecialchars($model->mailaddr); ?>
									</div>
                                </div>

                                <div class="field last_name">
                                    <div class="title">Họ tên&nbsp;</div>
                                    <div class="data">
										<?php echo htmlspecialchars($model->lastname . ' ' . $model->firstname); ?>
									</div>
                                </div>

                                

                                <div class="field birth">
                                    <div class="title">Ngày sinh&nbsp;</div>
                                    <div class="data">
									 <?php 
									  $birthday = explode("/",$model->birthday); 
									  echo $birthday['2']."/".$birthday['1']."/".$birthday['0']."/";
									 ?>
									</div>
                                </div>

                                <div class="field joined_year">
                                    <div class="title">Năm tham gia&nbsp;</div>
                                    <div class="data"><?php echo $model->joindate; ?></div>
                                </div>
                                 <div class="field joined_year">
                                    <div class="title">Chi nhánh&nbsp;</div>
                                    <div class="data">
                                        <?php  
										
												echo $unit_name;
												
												
												 
										
								?>
                                    </div>
                                </div>
                                <div class="field joined_year">
                                    <div class="title">Bộ phận&nbsp;</div>
                                    <div class="data">
                                       <?php echo htmlspecialchars($post_name);?>
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
                            		<?php 
                                        $cookie_key_name='file_user_edit_attachment';
                                        if(Yii::app()->request->cookies[$cookie_key_name.'4']!=NULL){
                                            $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name.'4']->value));
                                        }
                                        else{
                                            $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->photo));      
                                        }
									if ($model->photo_checkbox_for_deleting == '0'){
                                                                                 if (trim($model->photo) != ""||(Yii::app()->request->cookies[$cookie_key_name.'4']!=NULL&&file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name.'4']->value))) {//upload new file                                            
											
									?>
                                <div class="building_photo">
                                       	 <style>
											div.building_photo a{float:none !important;} 	
											a.a_base{float:none !important;}	
                                            img.img_base{ position:relative !important; float:none !important;}
                                        </style>	
    									<?php
                                 		                        $attachement4 = $this->beginWidget('ext.helpers.Form_new');									
                                                                        $attachement4->editConfirm14($model, $form,'adminuser',Yii::app()->request->baseUrl);
									$this->endWidget();
                                            
									 	?>
                                        <p style="width:228px; float:left; margin-left: 15px;"><span>Ảnh</span></p>
                                    
                                </div>
                               <?php } }?>
                                
                            </div>
                            <!-- /boxR -->

                        </div><!-- /baseDetailBox -->
						
                   
                        <div class="baseDetailBox">
                           
                            <div class="textBox mt15 clearfix">
                                

                                <div class="field1 comment">
                                    <div class="title">Ghi chú&nbsp;</div>
                                    <div class="data">
										<?php echo nl2br(htmlspecialchars($model->comment));?>	
									</div>
                                </div>

                            </div><!-- /boxL -->

                        </div><!-- /baseDetailBox -->
                        <?php $this->endWidget(); ?> 
                    </div><!-- /cnt-box -->


                    <div class="form-last-btn">
                        <div class="btn170">
                            <button id="back" class="btn" type="submit">
								<i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?>
							</button>
                            <button id="submit" class="btn btn-important" type="submit">
								<i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM;?>
							</button>
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
            </div><!-- /sideBox -->

        </div><!-- /contents -->
        

</div>

