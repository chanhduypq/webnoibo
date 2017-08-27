<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/ideas.css" rel="stylesheet" type="text/css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>

<?php $attachment1=$model->attachment1;?>
<?php $attachment2=$model->attachment2;?>
<?php $attachment3=$model->attachment3;?>
<?php $attachment1_ext=FunctionCommon::getExtensionFile($model->attachment1);?>
<?php $attachment2_ext=FunctionCommon::getExtensionFile($model->attachment2);?>
<?php $attachment3_ext=FunctionCommon::getExtensionFile($model->attachment3);?>

<div class="wrapper secondary ideas">

    
        <div class="contents detail">
        	<?php
        $home_link = '/work';
        $link_array = array();
        $link_array[] = array("text" => "Ý tưởng mới", "link" => '/workideas');
        $link_array[]=array("text"=>  Config::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV,"link"=>'/workideas/detail') ; 
        $this->widget('Path_actionwidget', array('home_link' => $home_link, 'link_array' => $link_array));
        ?>
            <div class="mainBox detail">
            	<div class="pageTtl">
					<h2></h2>
                 <span>
					<?php if(Yii::app()->request->cookies['page'] != NULL): ?>	
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/workideas/index?page=<?php echo Yii::app()->request->cookies['page']?>" class="btn btn-important">
							<i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
						</a>
					<?php else : ?>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/workideas" class="btn btn-important">
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
			
                    <div class="evaluate">
                    	<?php
                        	 $i = 0; 
							 $rating = 0;
							 $id = $model->id;
							 foreach ($ideas_list_comments as $comment) {
								 if($id ==$comment['ideas_id']){ 
								 $i = $i+1;
								 $rating = $comment['valuation']+ $rating;
								 } 
							 }
							if($i!=0){
								$average = $rating/$i;
								$average = substr($average, 0, 3);
								if($average==0){$star = "star0"; $average=0;}
								else if($average > 0 && $average <= '1.5'){ $star = "star1";}
								else if($average > '1.5' && $average <= '2.5'){ $star = "star2";}
								else if($average > '2.5' && $average <= '3.5'){ $star = "star3";}
								else if($average > '3.5' && $average <= '4.5'){ $star = "star4";}
								else if($average > '4.5' ){ $star = "star5";}
							}
							else {$star = "star0"; $average=0;}
						?>
                        <p class="rating"> Đánh giá： <span class="star <?php echo $star?>"></span>(<?php echo $average?>)</p>
                        <p class="comment">Bình luận: <?php echo $i;?></p>
                        <span class="clearfix"></span>
                    </div>
					
                    <p class="cnt-box">
							<?php echo nl2br(htmlspecialchars($model->content));?>
					</p>
					<?php                    
                    $attachements = $this->beginWidget('ext.helpers.Form');
                    $attachements->detail($model, 'adminideas',Yii::app()->request->baseUrl,$edit=true);                        
                    $this->endWidget();
                    ?>                
                <?php endif; ?>
                </div>
				<!-- /box -->
                                <div class="box">
                	<h3>Bình luận</h3>
					<?php
					$form = $this->beginWidget('CActiveForm', array(
										'id' => 'ideas_comment_form',                     
										'htmlOptions' => array(
															  'class'=>'form-horizontal',
															  'onsubmit'=>'return false;',
															  ),
										 ));
					echo $form->hiddenField($model, 'id');	
					echo $form->hiddenField($model, 'contributor_id');		
					echo $form->hiddenField($model, 'last_updated_person');			
					?>
                     <div class="control-group">
                                    <label class="control-label" for="title">Bình luận&nbsp;
                                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                                    <div class="controls">
                                        <?php echo $form->error($ideas_comment, 'comment'); ?>
                                        <?php echo $form->textarea($ideas_comment, 'comment', array('class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 512)); ?>
                                    </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="title">Đánh giá&nbsp;</label>
                        <div class="controls">
                        	<?php 
								$array_rating = array(0=>'',1=>'★',2=>'★★',3=>'★★★',4=>'★★★★',5=>'★★★★★');
								echo $form->dropDownList($ideas_comment,'valuation',$array_rating, array('class' => 'input-small')); ?>
                        </div>
                    </div>
                    <div class="form-last-btn">
                        <p class="btn170">
                        	 <?php
							 if(FunctionCommon::isPostFunction("ideas")==true){
							?>
									<button type="submit" class="btn btn-important"><i class="icon-chevron-right icon-white">　</i> Gửi</button>
							 <?php }else{?>
									<button disabled="disabled" type="submit" class="btn btn-important"><i class="icon-chevron-right icon-white">　</i> Gửi</button>
							 <?php }?>       
		                  
	                    </p>
                    </div>                          
                    <?php $this->endWidget(); ?>    
                    <h3>Các bình luận trước</h3>
					<ul class="comments">
                    	<?php
						   $i = 1;	
						   foreach ($ideas_list_comments as $comment) {
						?>
								<li>
                                    <p class="comment">
									<?php echo nl2br(FunctionCommon::url_henkan($comment->comment));?>	
									</p>
                                                                        <div class="commenter row">
                                                                            <div style="float:left;margin-left: 100px;">Đánh giá: 
                                        <?php 
										$rating = $comment->valuation;
										switch ($rating) 
										   {
												case "1":
													$star = "star1";
													break;
												case "2":
													$star = "star2";
													break;
												case "3":
													$star = "star3";
													break;	
												case "4":
													$star = "star4";
													break;	
												case "5":
													$star = "star5";
													break;	
												default:
													$star = "star0";
												}
										?>
                                        <span class="star <?php echo $star;?>"></span>(<?php echo $rating;?>)</div>
                                        <div style="float:left;margin-left: 20px;"><?php
										 foreach ($user as $user_name) {
											 if($user_name['id']== $comment->contributor_id)
											 {
										 		echo $user_name['lastname']." ".$user_name['firstname'];
											 }
										 }
										 ?></div>
                                        <div style="float:left;margin-left: 60px;">Thời gian gửi：<?php echo FunctionCommon::formatDate($comment->created_date); ?> <?php echo FunctionCommon::formatTime($comment->created_date); ?></div>
                                        <div style="clear: both;"></div>
                                    </div> 
                                </li>
						<?php
								$i++;	
							   }
							 
						?>
						
                    </ul>                      
				 </div><!-- Box -->
         
            </div>
			<!-- /mainBox -->
            
            
        </div><!-- /contents -->
        

</div>
<!-- /wrap -->
<script type="text/javascript">   
        jQuery(function($){  
            $("body").attr('id','work');    
           $('button[type="submit"]').click(function(){ 
		   var ok = confirm('Bạn có chắc gửi bình luận này không？');  
		   if(ok ==true)
		   { 
		   		if(checkId(<?php echo $_GET['id']?>)){} 
					$.ajax({    
						type: "POST", 
						async:true,
						url: "<?php echo Yii::app()->baseUrl;?>/workideas/detail/?id=<?php echo $model->id;?>",    
						data: jQuery('#ideas_comment_form').serialize(),
						success: function(msg){	                        
								jQuery('#ideas_comment_form input, #ideas_comment_form textarea').prev().remove();
								if(msg!='[]'){
															data=$.parseJSON(msg);
															if(data.Ideas_comment_comment){
																 div=document.createElement('div');
																 $(div).addClass('alert');
																 $(div).addClass('error_message');
																 $(div).html(data.Ideas_comment_comment);
																 $(div).insertBefore($('#Ideas_comment_comment')); 
															} 
								}							  															
							else{   
							
													$("#ideas_comment_form").attr('action','<?php echo Yii::app()->baseUrl;?>/workideas/detail/?id=<?php echo $model->id;?>');
													jQuery('#ideas_comment_form').attr('onsubmit','return true;');
													jQuery('#ideas_comment_form').submit();
													
												}					    			    
						}	  
					});
				  }	
			});    
				   
		 
        });
		//check id
		function checkId(id)
		{
			$.ajax({   
			type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/workideas/checkId/",    
				data:{id:id},
				success: function(msg){	                  
					if(msg>0){ 
						window.location.href='<?php echo Yii::app()->baseUrl;?>/workideas';
					}
				}
			});			
		}
</script>
