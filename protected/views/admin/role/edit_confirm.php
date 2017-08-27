<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin role"> 

    
        <div class="contents index">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Phân quyền","link"=>'/adminrole') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminrole/editconfirm') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?> 
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2>
                </div>
                <div class="box">
                 <?php $form = $this->beginWidget('CActiveForm', array(
						'id' => 'confirm_role_form', 
                        'htmlOptions' => array(
						'enctype' => 'multipart/form-data',
						'class'=>'form-horizontal'
						),));?>
                  <div class="cnt-box">
                <div class="form-horizontal">
                   <div class="control-group">
                        <div class="control-label">Quyền&nbsp;</div>
                        <div class="controls">
                        	<p class="mt5">
                                <input  name="role[id]" type="hidden" value="<?php echo $roles['id'] ?>"/>
                                <input  name="role[role_name]" type="hidden" value="<?php echo htmlspecialchars($roles['role_name']) ?>"/>
                                <?php echo htmlspecialchars($roles['role_name']);?>
                            </p>
                        </div>
                    </div>
                    <?php foreach ($role_management as $key=>$val){
                    ?>
                    <input type="hidden" readonly="readonly" name="data[<?php echo $key ?>][function_id]" value="<?php echo $val['function_id']?>"/>
                    <input type="hidden" readonly="readonly" name="data[<?php echo $key ?>][view]" value="<?php echo $val['view']?>"/>
                    <input type="hidden" readonly="readonly" name="data[<?php echo $key ?>][post]" value="<?php echo $val['post']?>"/>
                    <input type="hidden" readonly="readonly" name="data[<?php echo $key ?>][admin]" value="<?php echo $val['admin']?>"/>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo htmlspecialchars($val['function_name']) ?>&nbsp;
						</div>
                        <div class="controls">
                        	<div>
                              <?php if($val['view']==1) echo '<div class="view_role">Xem</div>';
                               if($val['post']==1) echo '<div class="post_role">Đăng tin</div>';
                               if($val['admin']==1) echo '<div class="control_role">Quản trị</div>';
                              ?>
	                        	
                        	</div>
                        </div>
                    </div>
                   
                    <?php

                    }
                    ?>
                    
                </div>
                    
                </div><!-- /cnt-box -->
                 <?php $this->endWidget(); ?>
                <div class="form-last-btn">
                    <div class="btn170">
                        <button type="submit" class="btn" onclick="history.back();" id="back"><i class="icon-chevron-left"></i> <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button>
                        <button type="submit" class="btn btn-important" id="submit"><i class="icon-chevron-right icon-white"></i> <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM;?></button>
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
<script>
    jQuery(function($) {
        $('button#submit').click(function(){  
            deleteCookies('rolename');
            deleteCookies('checkdata');                    
            jQuery("form#confirm_role_form").submit();
        });
    });
    
    
</script>
