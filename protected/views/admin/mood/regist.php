<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin">
    
        <div class="contents regist">
            <?php
            $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Tâm trạng","link"=>'/adminmood') ;   
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/adminmood/regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox detail">
            	<div class="pageTtl">
                    <h2></h2>
                    <span>
                    
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/adminmood/">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'mood_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                         
                                          ),
                        ));
                ?>
                    
                
                                            
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
	                    <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">&#12288;</i>  <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_REGIST;?></button>
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

      
           $("#mood_form").attr('action','<?php echo Yii::app()->baseUrl;?>/adminmood/registconfirm/');          
           name=getCookie("mood_regist_name");
           if(name!=null&&name!="null"){
               $("#Mood_name").val(name);
           }
           
          
          
           setCookie("mood_regist_name",$("#Mood_name").val());
          

            /**
             * 
             */
           $("body").attr('id','admin');      
        
           $('button[type="submit"]').click(function(){  

			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminmood/regist/",    
				data: jQuery('#mood_form').serialize(),
				success: function(msg){	                        					  		
					  jQuery('#Mood_name').prev().remove();                                       						                                            					  	
					  
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
                                                    if(data.Mood_name){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Mood_name);
                                                         $(div).insertBefore($('#Mood_name'));
                                                         
                                                    } 
                                                    
                                                }							  															
					else{                                           
                                                setCookie("mood_regist_name",$("#Mood_name").val());
                                                
                                                jQuery('#mood_form').submit();
                                        }							    			    
				}	  
			});			
		});                          
        });
</script>
