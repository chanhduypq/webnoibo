<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>



<div class="wrapper secondary">

    
        <div class="contents detail">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Thông báo từ phòng hành chính nhân sự","link"=>'/adminhr') ; 
        $link_array[]=array("text"=>"Rời khỏi","link"=>'/adminhr/leave') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/adminhr/leave_detail') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>  
            <div class="mainBox detail">
            	<div class="pageTtl">
					<h2></h2>
                 <span>
					<?php if(Yii::app()->request->cookies['page'] != NULL): ?>	
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhr/leave?page=<?php echo Yii::app()->request->cookies['page']?>" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						</a>
					<?php else : ?>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhr/leave" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						</a>
					<?php endif; ?>
				</span>
                                        <span><a href="<?php echo Yii::app()->request->baseUrl; ?>/adminhr/leave_edit/?id=<?php echo $member_leave['id']; ?>" class="btn btn-work"><i class="icon-pencil icon-white"></i><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_DETAIL;?></a></span>
                </div>
                <div class="box">
				<?php if(isset($member_leave)&&  is_array($member_leave)&&count($member_leave)>0): ?>	
        			<div class="postsDate">
						<i class="icon-pencil"></i> <?php echo Config::TEXT_FOR_SHOW_HEADER_DETAIL;?>
						<span class="date">
							<?php echo FunctionCommon::formatDate($member_leave['created_date']); ?>
						</span>
						<span class="time">
							<?php echo FunctionCommon::formatTime($member_leave['created_date']); ?>
						</span>
					</div>
                	<div class="detailTtl">
                    	<h3 class="ttl">
							
						</h3>
                        <p class="area">
							<?php 
								$arrUser = FunctionCommon::getInforUser($member_leave['contributor_id']);
								if(isset($arrUser)){ echo $arrUser; }
							?>
						</p>
                    </div>
					
			<h4></h4>	
                    <div style="float: left;margin-right: 20px;text-align: right;width: 140px;">
                        Tên thành viên
                    </div>
                    <div style="float: left;width: 500px;">
                        <?php  echo htmlspecialchars($member_leave['member_name']); ?>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="float: left;margin-top: 20px;margin-right: 20px;text-align: right;width: 140px;">
                        Ngày gia nhập
                    </div>
                    <div style="float: left;margin-top: 20px;width: 500px;">
                        <?php  echo FunctionCommon::formatDate($member_leave['leave_date']); ?>
                    </div>
                    <div style="clear: both;"></div>
                    <br/>
                    <h4>Rời khỏi từ</h4>
                    <div style="float: left;margin-top: 20px;margin-right: 20px;text-align: right;width: 140px;">
                        Chi nhánh
                    </div>
                    <div style="float: left;margin-top: 20px;width: 500px;">
                        <?php  echo htmlspecialchars($member_leave['unit_name']); ?>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="float: left;margin-top: 20px;margin-right: 20px;text-align: right;width: 140px;">
                        Bộ phận
                    </div>
                    <div style="float: left;margin-top: 20px;width: 500px;">
                        <?php  echo htmlspecialchars($member_leave['post_name']); ?>
                    </div>                    
                    <div style="clear: both;"></div>
                    <br/>
                    <h4></h4>
                    <div style="float: left;margin-top: 20px;margin-right: 20px;text-align: right;width: 140px;">
                        Ghi chú
                    </div>
                    <div style="float: left;margin-top: 20px;width: 500px;">
                        <p>
							<?php echo nl2br(htmlspecialchars($member_leave['detail']));?>
					</p>
                    </div>
                    <div style="clear: both;"></div>
                                        
                                            
                                        
                <?php endif; ?>
                                           
                </div>
                
				<!-- /box -->
         
            </div>
			<!-- /mainBox -->
            
            
        </div><!-- /contents -->
        

</div>
<!-- /wrap -->
