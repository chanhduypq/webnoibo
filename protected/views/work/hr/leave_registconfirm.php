<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<div class="wrapper secondary">

    
        <div class="contents confirm">
        	<?php
        	$home_link='/work';
        $link_array=array();
        $link_array[]=array("text"=>"Thông báo từ phòng hành chính nhân sự","link"=>'/workhr') ; 
        $link_array[]=array("text"=>"Rời khỏi","link"=>'/workhr/leave') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/workhr/leave_regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>            
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2></div>
                <div class="box">
                <?php
				$form = $this->beginWidget('CActiveForm', array(
					'id' => 'hr_form',    
					'htmlOptions' => array('enctype' => 'multipart/form-data','action'=>Yii::app()->baseUrl.'/workhr/leave_registconfirm'),
						));
				?> 
					<input type="hidden" name="file_index"/>
                    <div class="cnt-box">
                        <div class="form-horizontal">
                        	<h4></h4>
                            <div class="control-group">
                                <div class="control-label">Tên thành viên</div>
                                <div class="controls">
                                    <p><?php echo htmlspecialchars($model->member_name);?></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label">Ngày gia nhập</div>
                                <div class="controls">
                                    <p><?php echo htmlspecialchars($model->leave_date);?></p>
                                </div>
                            </div>
                            <h4>Rời khỏi từ</h4>
                            <div class="control-group">
                                <div class="control-label">Chi nhánh</div>
                                <div class="controls">
                                    <p><?php  
										foreach($unit as $units){
											if($model->unit==$units['id']){
												echo $units['unit_name'];
												
												
												 
											}
										 }
								?></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label">Bộ phận</div>
                                <div class="controls">
                                    <p><?php echo htmlspecialchars($post_name);?></p>
                                </div>
                            </div>
                            <h4></h4>
                            <div class="control-group">
                                <div class="control-label">Ghi chú</div>
                                <div class="controls">
                                    <p><?php echo nl2br(htmlspecialchars($model->detail));?>	</p>
                                </div>
                            </div>
                        </div>                   
                       
                </div><!-- /cnt-box -->	
						<?php 
                                                echo $form->hiddenField($model, 'id');
                                                echo $form->hiddenField($model, 'unit'); 
                                                echo $form->hiddenField($model, 'position'); 
                                                echo $form->hiddenField($model, 'leave_date'); 
                                                echo $form->hiddenField($model, 'member_name'); 
                                                echo $form->hiddenField($model, 'detail'); ?>  
                        <input type="hidden" name="regist" id="regist" value="1"/>
                        <?php $this->endWidget(); ?>         	
                <div class="form-last-btn">
                    <div class="btn170">
                        <button type="submit" class="btn" id="back"><i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button> 
                        <button class="btn btn-important" type="submit"  id="submit"><i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM;?></button>
                    </div>
                </div>

            </div><!-- /box -->
        </div><!-- /mainBox -->
            
        </div><!-- /contents -->
       

</div>
<script type="text/javascript">
    jQuery(function($) { 
        
        $("body").attr('id','work');          
        $(window).on('beforeunload', function(){
            setCookie("hr_leave_regist_from","confirm");            
        }); 
		
        
        
        setCookie("hr_leave_regist_member_name",$("#Leave_member_name").val()); 
        setCookie("hr_leave_regist_detail",$("#Leave_detail").val());
        setCookie("hr_leave_regist_unit",$("#Leave_unit").val());
       setCookie("hr_leave_regist_position",$("#Leave_position").val());
       setCookie("hr_leave_regist_leave_date",$("#Leave_leave_date").val());
       
        $('button#submit').click(function(){  
            
            deleteCookies("hr_leave_regist_from");
            jQuery("input#regist").val('1');            
            jQuery("form#hr_form").submit();
        });
        $('button#back').click(function(){  
		  	
            setCookie("hr_leave_regist_from","confirm");   
            window.location="<?php echo Yii::app()->baseUrl;?>/workhr/leave_regist/";
        });
          
    });
</script>