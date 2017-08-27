<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/tab_cv.css" rel="stylesheet" media="screen"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>

<?php $attachment1=$model->attachment1;?>
<?php $attachment2=$model->attachment2;?>
<?php $attachment3=$model->attachment3;?>
<?php $attachment1_ext=FunctionCommon::getExtensionFile($model->attachment1);?>
<?php $attachment2_ext=FunctionCommon::getExtensionFile($model->attachment2);?>
<?php $attachment3_ext=FunctionCommon::getExtensionFile($model->attachment3);?>

<div class="wrapper secondary">

    
        <div class="contents detail">
        	<?php
        $home_link = '/work';
        $link_array = array();
        $link_array[] = array("text" => "Thông báo nội bộ", "link" => '/worknotice');
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/worknotice/detail') ; 
        $this->widget('Path_actionwidget', array('home_link' => $home_link, 'link_array' => $link_array));
        ?>
            <div class="mainBox detail">
            	<div class="pageTtl">
					<h2></h2>
                 <span>
					<?php if(Yii::app()->request->cookies['page'] != NULL): ?>	
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/worknotice/index?page=<?php echo Yii::app()->request->cookies['page']?>" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						</a>
					<?php else : ?>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/worknotice" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						</a>
					<?php endif; ?>
				</span>
                </div>
                <div class="box">
				<?php if(!is_null($model)): ?>	
        			<div class="postsDate">
						<i class="icon-pencil"></i> <?php echo Config::TEXT_FOR_SHOW_HEADER_DETAIL;?>
						<span class="date">
							<?php echo FunctionCommon::formatDate($model->created_date); ?>
						</span>
						<span class="time">
							<?php echo FunctionCommon::formatTime($model->created_date); ?>
						</span>
					</div>
                	<div class="detailTtl">
                            <?php
                                        $team_array=  Config_team_notice::$team_array;
                                        if(is_array($team_array)&&count($team_array)>0){
                                            
                                            foreach ($team_array as $key=>$value){
                                                if($key==$model->icon){
                                                    echo '<div style="margin-right: 10px;margin-top: 9px;" class="n_group cl'.$key.'">'.$value.'</div>';
                                                }
                                            }
                                        }                                    
                                    ?>
                            
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
					<?php                    
                    $attachements = $this->beginWidget('ext.helpers.Form');
                    $attachements->detail($model, 'adminnotice',Yii::app()->request->baseUrl,$edit=true);                        
                    $this->endWidget();
                    ?>                
                <?php endif; ?>
                </div>
				<!-- /box -->
         
            </div>
			<!-- /mainBox -->
            
            
        </div><!-- /contents -->
        

</div>
<!-- /wrap -->
