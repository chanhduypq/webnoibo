<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin">
    
        <div class="contents regist"> 
<?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Thành viên bóng đá","link"=>'/adminhobby_itd') ;        
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminhobby_itd/edit') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>            
            <div class="mainBox detail">
            	<div class="pageTtl">
                    <h2></h2>
                    <span>
                    <?php 
					if(Yii::app()->request->cookies['page']!= NULL) 
					{
						   $page = "index?page=".Yii::app()->request->cookies['page']->value;
							
					}else {$page ="";}
					?>
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/adminhobby_itd/<?php echo $page;?>">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'hobby_itd_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                         
                                          ),
                        ));
                ?>
                    <input type="hidden" name="photo" id="photo"/>
                    <input type="hidden" name="lastname" id="lastname"/>
                    <input type="hidden" name="firstname" id="firstname"/>
                    <input type="hidden" name="id_unit" id="id_unit"/>
                    <input type="hidden" name="id_position" id="id_position"/>
                    <?php echo $form->hiddenField($model, 'id'); ?>  
                
                                            
                <div class="cnt-box"> 
                    <div class="control-group">
                        <label for="title" class="control-label">Chi nhánh-bộ phận&nbsp;
                            <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        		<?php
                                $array_unit = array();
								foreach ($unit as $unit_name){
									   $array_unit[$unit_name['unitid'].'-'.$unit_name['postid']] = $unit_name['unit_name'].' - '.$unit_name['post_name'];
									   
								}
								echo $form->dropDownList($model,'unit_id',$array_unit,  array('prompt'=>'Chọn chi nhánh - bộ phận','options' => array($post_unit_id => array('selected' => true)))); 			
								?> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="title" class="control-label">Nhân viên&nbsp;
                        	<span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">                        	
                                <?php echo $form->dropDownList($model, 'user_id', $model->allUsers, array('options' => array($model->user_id => array('selected' => true)))); ?> 
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
                        $("#Hobby_itd_user_id").click(function() {
    options=$("#Hobby_itd_user_id option");
    if(options.length==1&&$("#Hobby_itd_unit_id").val()==""){
        alert("Vui lòng chọn Chi nhánh - bộ phận trước");
    }
});
            user_id1=getCookie("hobby_itd_edit_user_id");
if(user_id1!=null&&user_id1!="null"){
    user_id1=user_id1;
}
else{
    user_id1='<?php echo $model->user_id;?>';
}
            
            var str_id=$("#Hobby_itd_unit_id").val();
            
            str_id=str_id.split("-",2);
            unit_id=str_id[0];
            position_id=str_id[1];
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Hobby_itd_user_id').html("");
                                     jQuery('#Hobby_itd_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        if(user_id1==users[i].id){
                                            jQuery('#Hobby_itd_user_id').append("<option selected='selected' value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                        }
                                        else{
                                            jQuery('#Hobby_itd_user_id').append("<option value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                        }
                                        
                                    }    
                                }
                });
                
				
                $("input#id_unit").val(unit_id);
                $("input#id_position").val(position_id);
                
                
                
                
                
                
                
                

        $("#Hobby_itd_unit_id").change(function() {
            
            var str_id=$(this).val();
            if(str_id==''){
                str_id='0-0';
            }
            str_id=str_id.split("-",2);
            unit_id=str_id[0];
            position_id=str_id[1];
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Hobby_itd_user_id').html("");
                                     jQuery('#Hobby_itd_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Hobby_itd_user_id').append("<option value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                    }    
                                }
                });
                
				
                $("input#id_unit").val(unit_id);
                $("input#id_position").val(position_id);
           }); 
           $("#Hobby_itd_user_id").change(function() {
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/getuser/?user_id="+$(this).val(),    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#firstname").val(users[i].firstname);
                                        $("input#lastname").val(users[i].lastname);
                                        $("input#photo").val(users[i].photo);
                                    }   
                                     
                                }
                });
                
           }); 
           $("#hobby_itd_form").attr('action','<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/editconfirm/');          
           
          
           unit_id=getCookie("hobby_itd_edit_unit_id");     
           if(unit_id!=null&&unit_id!="null"){
               $("#Hobby_itd_unit_id").val(unit_id);
                
            str_id=unit_id.split("-",2);
            unit_id=str_id[0];
            position_id=str_id[1];
               user_id=getCookie("hobby_itd_edit_user_id"); 
               
               $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Hobby_itd_user_id').html("");
                                     jQuery('#Hobby_itd_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Hobby_itd_user_id').append("<option value='" + users[i].id+"'" +(users[i].id==user_id?' selected':'')+ ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                    }    
                                }
                });
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/getuser/?user_id="+user_id,    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#firstname").val(users[i].firstname);
                                        $("input#lastname").val(users[i].lastname);
                                        $("input#photo").val(users[i].photo);
                                    }   
                                     
                                }
                });
              
               $("input#id_unit").val(unit_id);
               $("input#id_position").val(position_id);
               
           }
          
          
          

            /**
             * 
             */
           $("body").attr('id','admin');      
        
           $('button[type="submit"]').click(function(){  

			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/edit/?id=<?php echo $model->id;?>",    
				data: jQuery('#hobby_itd_form').serialize(),
				success: function(msg){	                        					  		
					  
					 
                                          jQuery('#Hobby_itd_unit_id').prev().remove();
                                          jQuery('#Hobby_itd_user_id').prev().remove();
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
                                                    
                                                   
                                                    if(data.Hobby_itd_unit_id){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Hobby_itd_unit_id);
                                                         $(div).insertBefore($('#Hobby_itd_unit_id'));                                                         
                                                    }
                                                    if(data.Hobby_itd_user_id){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Hobby_itd_user_id);
                                                         $(div).insertBefore($('#Hobby_itd_user_id'));                                                         
                                                    }
                                                }							  															
					else{                                           
                                                
                                               
                                                setCookie("hobby_itd_edit_unit_id",$("#Hobby_itd_unit_id").val());
                                                setCookie("hobby_itd_edit_user_id",$("#Hobby_itd_user_id").val());
                                                jQuery('#hobby_itd_form').submit();
                                        }							    			    
				}	  
			});			
		});                          
        });
</script>
