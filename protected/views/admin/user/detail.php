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
<div class="wrapper secondary admin">

   
        <div class="contents detail">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"user","link"=>'/adminuser') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/adminuser/detail') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2>
                <span><a class="btn btn-important" href="<?php echo Yii::app()->baseUrl;?>/adminuser/index?page=<?php echo Yii::app()->request->cookies['page']->value; ?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                <span><a class="btn btn-work" href="<?php echo Yii::app()->baseUrl;?>/adminuser/edit/?id=<?php echo $user["id"];?>"><i class="icon-pencil icon-white"></i><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_DETAIL;?></a></span></div>
                <div class="box">
                
                <div class="baseDetailBox">
                    
                    <div class="textBox boxL mt15 clearfix">
                        <div class="field staff_nmb">
                            <div class="title">ID nhân viên&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($user["employee_number"]);?>
								
								</p>
							</div>
                        </div>
                        <div class="field affili_post">
                            <div class="title">Phân quyền&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($user["role_name"]);?>
								</p>
							</div>
                        </div>
                        <div class="field mail">
                            <div class="title">Email&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($user["mailaddr"]);?>
								</p>
							</div>
                        </div>
    
                        <div class="field last_name">
                            <div class="title">Họ và tên&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($user["lastname"].' '.$user["firstname"]);?>
								</p>
							</div>
                        </div>
                        
                        
                        <div class="field birth">
                            <div class="title">Ngày sinh&nbsp;</div>
                            <div class="data">
                             <?php 
							  $birthday = FunctionCommon::formatDate($user['birthday']);
                                                          echo $birthday;

                             ?>
                            </div>
                        </div>
                        <div class="field joined_year">
                            <div class="title">Năm tham gia&nbsp;</div>
                            <div class="data">
								<?php echo $user["joindate"];?>
							</div>
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
                            <?php if(!empty($user['photo'])&&file_exists(Yii::getPathOfAlias('webroot').FunctionCommon::getFilenameInThumnail($user['photo']))):
                                $thumnail_file_path=  FunctionCommon::getFilenameInThumnail($user['photo']);
                                ?>
                             <a href="<?php echo Yii::app()->request->baseUrl.$user["photo"];?>" rel="prettyPhoto"> 
                                    <img style="height:171px;" src="<?php echo Yii::app()->request->baseUrl .$thumnail_file_path; ?>"/>
                             </a>             
                            <?php else:?>  
								 <img src="<?php echo Yii::app()->request->baseUrl;?>/css/common/img/img_dummyman.jpg">
							<?php endif ;?>	 
                            <p><span>Ảnh</span></p>
                        </div>
                    </div><!-- /boxR -->
                    
                </div><!-- /baseDetailBox -->
                
                <div class="baseDetailBox">
                    
                    <div class="textBox mt15 clearfix">
                       
                 
                        <div class="field1 comment">
                            <div class="title">Ghi chú&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo nl2br(htmlspecialchars($user["comment"]));?>	
								</p>
							</div>
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