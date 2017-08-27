<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>


<div class="wrapper secondary admin">
  
        <div class="contents regist"> 
<?php
            $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Design","link"=>'/admindesigncomment') ;   
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/admindesigncomment/edit') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>                
            <div class="mainBox detail">
            	<div class="pageTtl">
                    <h2>今日のありがとう - 修正</h2>
                    <span>
                    <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/admindesigncomment/<?php echo $page;?>">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'designcomment_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                         
                                          ),
                        ));
                ?>
                    <?php echo $form->hiddenField($model, 'id'); ?>      
                    <input type="hidden" name="photo" id="photo" value="<?php echo $photo;?>"/>
                    <input type="hidden" name="lastname" id="lastname" value="<?php echo $lastname;?>"/>
                    <input type="hidden" name="firstname" id="firstname" value="<?php echo $firstname;?>"/>
                    <input type="hidden" name="id_unit" id="id_unit" value="<?php if(isset($id_unit)){ echo $id_unit;}?>"/>
                
                                            
                <div class="cnt-box"> 
                    
                    <div class="control-group">
                        <label for="content" class="control-label">差出人&nbsp;
                            <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span>
                        </label>
                        <div class="controls">                        	
                                <?php echo $form->textField($model, 'name', array('placeholder' => 'お名前を入力してください。', 'class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    
                    
                    
                    
                  
                    
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                <div class="form-last-btn">
                	<p class="btn80">
	                    <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">&#12288;</i>  <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_EDIT;?></button>
                    </p>
                    
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

<script type="text/javascript">  
        jQuery(function($){ 

       
      
           $("#designcomment_form").attr('action','<?php echo Yii::app()->baseUrl;?>/admindesigncomment/editconfirm/');          
           name=getCookie("designcomment_edit_name");
           if(name!=null&&name!="null"){
               $("#Designcomment_name").val(name);
           }
              
           
           
           setCookie("designcomment_edit_name",$("#Designcomment_name").val());
           
            /**
             * 
             */
           $("body").attr('id','admin');      
        
           $('button[type="submit"]').click(function(){  
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/admindesigncomment/edit/?id=<?php echo $model->id;?>",    
				data: jQuery('#designcomment_form').serialize(),
				success: function(msg){	                        					  		
					  jQuery('#Designcomment_name').prev().remove();                                       						                                            					  	
					  
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
                                                    if(data.Designcomment_name){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Designcomment_name);
                                                         $(div).insertBefore($('#Designcomment_name'));
                                                         
                                                    } 
                                                    
                                                }							  															
					else{                                           
                                                setCookie("designcomment_edit_name",$("#Designcomment_name").val());
                                                
                                                
                                                jQuery('#designcomment_form').submit(); 
                                        }							    			    
				}	  
			});			
		});                         
        });
</script>
