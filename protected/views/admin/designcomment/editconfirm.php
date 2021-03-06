<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin">
    
        <div class="contents confirm">
        	<?php
            $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Design","link"=>'/admindesigncomment') ;   
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/admindesigncomment/editconfirm') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox detail">
            	<div class="pageTtl"><h2>今日のありがとう - 修正 確認</h2></div>
                <div class="box">
                      <?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'designcomment_form',    
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

                
                    <div class="cnt-box">
                    <div class="form-horizontal">

                        
                        
                        <div class="control-group">
                            <label for="content" class="control-label">差出人&nbsp;</label>
                            <div class="controls">
                                    <p><?php echo htmlspecialchars($model->name);?></p>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>                   
                        
                    
                    </div><!-- /cnt-box -->	
            		
    <?php echo $form->hiddenField($model, 'id'); ?>      
    
    <?php echo $form->hiddenField($model, 'name'); ?>  
    
                    <input type="hidden" name="edit" id="edit" value="1"/>
       	  <?php $this->endWidget(); ?> 
	                <div class="form-last-btn">
	                	<div class="btn170">
                                    <button type="submit" class="btn" id="back"><i class="icon-chevron-left"></i>  <?php echo Config::TEXT_FOR_BACK_IN_PAGE_CONFIRM;?></button>                                    
                                    <button class="btn btn-important" id="submit" type="submit"><i class="icon-chevron-right icon-white"></i>   <?php echo Config::TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM;?></button>
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery.cookies.js"></script>
<script type="text/javascript">
    
    
    jQuery(function($) { 
        
    
        
        $("body").attr('id','admin');          
        
        setCookie("designcomment_edit_name",$("#Designcomment_name").val());
        
        
        
        
        
       
        $('button#submit').click(function(){  
           
           
            jQuery("input#edit").val('1');            
            jQuery("form#designcomment_form").submit();
        });
        $('button#back').click(function(){
           
                          
            window.location="<?php echo Yii::app()->baseUrl;?>/admindesigncomment/edit/?id=<?php echo $model->id;?>";
        });
        
     
        
        
    });
     
    
</script>
