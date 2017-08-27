<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/hobby_new.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script type="text/javascript">
    jQuery(function($) {        
        $("body").attr('id','admin');        
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
					$("a#edit_profile").attr("href", "<?php echo Yii::app()->baseUrl;?>/adminprofile/edit/?id=<?php echo Yii::app()->request->cookies['id']->value;?>");
					});
				</script>
				<?php		
				}
				?>
                <a id="edit_profile" class="btn btn-work" href="<?php echo Yii::app()->baseUrl;?>/adminprofile/edit/?id=<?php echo Yii::app()->request->cookies['id']->value;?>"><i class="icon-pencil icon-white"></i> Thay đổi password</a></span></div>
                <div class="box">
                
                <?php
                if($user["passwd"]=='smile@gmorunsystem'){
				?>
                <p class="descriptionTxt">Vui lòng thay đổi password</p>
                <?php }?>
                <div class="baseDetailBox">
                    
                    <div class="textBox boxL mt15 clearfix">
                        <div class="field staff_nmb">
                            <div class="title">ID nhân viên&nbsp;</div>
                            <div class="data"><p><?php echo htmlspecialchars($user["employee_number"]);?></p></div>
                        </div>
                        <div class="field staff_pw">
                            <div class="title">password&nbsp;</div>
                            <div class="data"><?php $count=strlen($user["passwd"]);for($i=0;$i<$count;$i++) echo "*";?></div>
                        </div>
                        <div class="field mail">
                            <div class="title">Email&nbsp;</div>
                            <div class="data"><p><?php echo htmlspecialchars($user["mailaddr"]);?></p></div>
                        </div>
    
                        <div class="field last_name">
                            <div class="title">Họ tên&nbsp;</div>
                            <div class="data"><p><?php echo htmlspecialchars($user["lastname"].' '.$user["firstname"]);?></p></div>
                        </div>
                        
                        
                        <div class="field birth_day">
                            <div class="title">Ngày sinh&nbsp;</div>
                            <div class="data"><?php echo FunctionCommon::formatDate($user['birthday']); ?></div>
                        </div>
                        <div class="field joined_year">
                            <div class="title">Năm tham gia&nbsp;</div>
                            <div class="data"><?php echo $user["joindate"];?></div>
                        </div>
                        <div class="field joined_year">
                            <div class="title">Chi nhánh&nbsp;</div>
                            <div class="data">
								<?php echo $user["unit_name"];?>
							</div>
                        </div>
                <div class="field joined_year">
                            <div class="title">Bộ phận&nbsp;</div>
                            <div class="data">
								<?php echo $user["post_name"];?>
							</div>
                        </div>
                        <div class="field joined_year">
                                    <div class="title">Chức vụ&nbsp;</div>
                                    <div class="data">
                                        <?php  
                                        $position_array=  Config_position_user::$position_array;
                                        if(is_array($position_array)&&count($position_array)>0){
                                            foreach($position_array as $key=>$value){
                                                    if($user["chuc_vu"]==$key){
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
                            if($user['photo']!=""&&file_exists(Yii::getPathOfAlias('webroot').$user['photo'])){
                                $thumnail_file_path=  FunctionCommon::getFilenameInThumnail($user['photo']);
                                ?>
                               
                                <a href="<?php echo Yii::app()->request->baseUrl.$user["photo"];?>" rel="prettyPhoto"> 
                                        <img style="height:171px;" src="<?php echo Yii::app()->request->baseUrl .$thumnail_file_path; ?>"/>
                                    </a>             
                            <?php               
                            }
                            else{
                                echo '<img src="'.Yii::app()->request->baseUrl.'/css/common/img/img_dummyman.jpg">';
                            }
                            ?>
                            
                            <p><span>Ảnh</span></p>
                        </div>
                    </div><!-- /boxR -->
                    
                </div><!-- /baseDetailBox -->
                
                <div class="baseDetailBox">
                    
                    <div class="textBox mt15 clearfix">
                        
                        
                        <div class="field1 comment">
                            <div class="title">Ghi chú&nbsp;</div>
                            <div class="data"><p><?php echo nl2br(htmlspecialchars($user["comment"]));?></p></div>
                        </div>
                        
                    </div><!-- /boxL -->
                   	 
                </div><!-- /baseDetailBox -->
                
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
