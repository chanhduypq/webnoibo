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
<?php $attachment1=$model->attachment1;?>
<?php $attachment2=$model->attachment2;?>
<?php $attachment3=$model->attachment3;?>
<?php $attachment1_ext=FunctionCommon::getExtensionFile($model->attachment1);?>
<?php $attachment2_ext=FunctionCommon::getExtensionFile($model->attachment2);?>
<?php $attachment3_ext=FunctionCommon::getExtensionFile($model->attachment3);?>
<div class="wrap secondary admin">

   
        <div class="contents detail">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Chi nhánh","link"=>'/adminunit') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/adminunit/detail') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2>
                <span><a class="btn btn-important" href="<?php echo Yii::app()->baseUrl;?>/adminunit/index?page=<?php echo Yii::app()->request->cookies['page']->value; ?>"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                <span><a class="btn btn-work" href="<?php echo Yii::app()->baseUrl;?>/adminunit/edit/?id=<?php echo $model->id ;?>"><i class="icon-pencil icon-white"></i><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_DETAIL;?></a></span></div>
                <div class="box">
                
                <div class="baseDetailBox">
                    
                    <div class="textBox mt15 clearfix">
                        
                        <div class="field affili_post">
                            <div class="title">Tên chi nhánh&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($model->unit_name);?>
								</p>
							</div>
                        </div>
                        <div class="field mail">
                            <div class="title">Email&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($model->mailaddr);?>
								</p>
							</div>
                        </div>
                        <div class="field">
                            <div class="title">Khẩu hiệu&nbsp;</div>
                            <div class="data">
								<p>
									<?php echo htmlspecialchars($model->catchphrase);?>	
								</p>
							</div>
                        </div>
                        <div class="field1 comment">
                            <div class="title">Giới thiệu&nbsp;</div>
                            <div class="data">
								<p>
                                                                    
									<?php echo nl2br(FunctionCommon::url_henkan($model->introduction));?>	
								</p>
							</div>
                        </div>
                        <div class="photo">
                        <div class="imgbox">                            
                            	  <?php 
								   if(trim($attachment1)!="")
								   {	
										 FunctionCommon::echoOldFile($attachment1_ext, 1, $model,"adminunit",Yii::app()->request->baseUrl);
                                   }
                                   ?>
                        </div>
                        <div class="imgbox">
                           		 <?php 
								   if(trim($attachment2)!="")
								   {
								 		  FunctionCommon::echoOldFile($attachment2_ext, 2, $model,"adminunit",Yii::app()->request->baseUrl);	     
                                   }
                                   ?>
                        </div>
                        <div class="imgbox">
                           		 <?php 
								   if(trim($attachment3)!="")
								   {
								 		  FunctionCommon::echoOldFile($attachment3_ext, 3, $model,"adminunit",Yii::app()->request->baseUrl);	
                                   }
                                   ?>
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