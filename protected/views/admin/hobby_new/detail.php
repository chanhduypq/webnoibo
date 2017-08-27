<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/hobby_new.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script language="javascript">
$("body").attr('id','admin');     
</script>
<?php $attachment1=$model->attachment1;?>

<?php $attachment1_ext=FunctionCommon::getExtensionFile($model->attachment1);?>

<div class="wrapper secondary admin">
    
        <div class="contents detail">
            <?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Tin tức","link"=>'/adminhobby_new') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/adminhobby_new/detail') ; 
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
					<span>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhobby_new/edit/?id=<?php echo $model->id;?>" class="btn btn-work">
							<i class="icon-pencil icon-white"></i><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_DETAIL;?>
						</a>
					</span>
                </div>
                
                <div class="box">
                	<div class="postsDate">
						<i class="icon-pencil"></i> 
						<?php echo Config::TEXT_FOR_SHOW_HEADER_DETAIL;?>
						<span class="date">
							<?php echo FunctionCommon::formatDate($model->created_date); ?>
						</span>
						<span class="time">
							<?php echo FunctionCommon::formatTime($model->created_date); ?>
						</span>
					</div>
                	<div class="detailTtl">
                    	<h3 class="ttl">
							<?php  echo htmlspecialchars($model->title); ?>
						</h3>
						<p class="area">
							<?php 
								$arrUser = FunctionCommon::getInforUser($model->contributor_id);
								if(isset($arrUser)){ echo $arrUser; }
							?>
						</p>
                    </div>
						
                    <p class="cnt-box">
						 <?php echo nl2br(htmlspecialchars($model->content));?>
					</p>
				    <div class="photo">
						<div class="imgbox">                            
							<?php if(!empty($attachment1)): ?>
							<?php FunctionCommon::echoOldFile($attachment1_ext, 1, $model,"adminhobby_new",Yii::app()->request->baseUrl,true);	 ?>
							<?php endif; ?>
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
        

</div><!-- /wrap -->