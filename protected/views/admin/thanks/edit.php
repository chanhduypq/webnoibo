<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<div class="wrapper secondary admin">
    
        <div class="contents regist"> 
<?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Happy boy","link"=>'/adminthanks') ;        
        $link_array[]=array("text"=>  Config::TEXT_FOR_EDIT_IN_LINK_BACK_DIV,"link"=>'/adminthanks/edit') ;        
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
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/adminthanks/<?php echo $page;?>">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'thanks_form',                     
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
                    <div class="control-group">
                        <label for="content" class="control-label">Nội dung&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">                        	
                                <?php echo $form->textarea($model, 'comment', array('placeholder' => 'Vui lòng nhập nội dung', 'class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 512)); ?>   
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="content" class="control-label">Người gửi tin&nbsp;      </label>                  
                        <div class="controls">                        	
                                <?php echo $form->textField($model, 'sender', array('placeholder' => 'Vui lòng nhập người gửi tin', 'class' => 'input-xlarge')); ?>
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
            $("#Thanks_user_id").click(function() {
    options=$("#Thanks_user_id option");
    if(options.length==1&&$("#Thanks_unit_id").val()==""){
        alert("Vui lòng chọn Chi nhánh - bộ phận trước");
    }
});
user_id1=getCookie("thanks_edit_user_id");
if(user_id1!=null&&user_id1!="null"){
    user_id1=user_id1;
}
else{
    user_id1='<?php echo $model->user_id;?>';
}
            var str_id=$("#Thanks_unit_id").val();
            
            str_id=str_id.split("-",2);
            unit_id=str_id[0];
            position_id=str_id[1];
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Thanks_user_id').html("");
                                     jQuery('#Thanks_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        if(user_id1==users[i].id){
                                            
                                            jQuery('#Thanks_user_id').append("<option selected='selected' value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                        }
                                        else{
                                            jQuery('#Thanks_user_id').append("<option value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                        }
                                        
                                    }    
                                }
                });
                
				
                $("input#id_unit").val(unit_id);
                $("input#id_position").val(position_id);
                
                
                
                
                
                
                
                

        $("#Thanks_unit_id").change(function() {
            
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
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Thanks_user_id').html("");
                                     jQuery('#Thanks_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Thanks_user_id').append("<option value=" + users[i].id + ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                    }    
                                }
                });
                
				
                $("input#id_unit").val(unit_id);
                $("input#id_position").val(position_id);
           }); 
           $("#Thanks_user_id").change(function() {
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/getuser/?user_id="+$(this).val(),    				
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
           $("#thanks_form").attr('action','<?php echo Yii::app()->baseUrl;?>/adminthanks/editconfirm/');          
           sender=getCookie("thanks_edit_sender");
           if(sender!=null&&sender!="null"){
               $("#Thanks_sender").val(sender);
           }
           comment=getCookie("thanks_edit_comment");         
           if(comment!=null&&comment!="null"){
               comment1=comment.replace(/<br ?\/?>|_/g, '\n');         
               $("#Thanks_comment").val(comment1);
           }
           unit_id=getCookie("thanks_edit_unit_id");     
           if(unit_id!=null&&unit_id!="null"){
               $("#Thanks_unit_id").val(unit_id);
                
            str_id=unit_id.split("-",2);
            unit_id=str_id[0];
            position_id=str_id[1];
               user_id=getCookie("thanks_edit_user_id"); 
               $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/getusers/?unit_id="+unit_id+"&position_id="+position_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Thanks_user_id').html("");
                                     jQuery('#Thanks_user_id').append("<option value=''>Chọn nhân viên</option>");
                                    
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Thanks_user_id').append("<option value='" + users[i].id+"'" +(users[i].id==user_id?' selected':'')+ ">" + users[i].lastname+' '+users[i].firstname + "</option>");
                                    }    
                                }
                });
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/getuser/?user_id="+user_id,    				
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
          
           setCookie("thanks_edit_sender",$("#Thanks_sender").val());
           setCookie("thanks_edit_comment",comment); 

            /**
             * 
             */
           $("body").attr('id','admin');      
        
           $('button[type="submit"]').click(function(){  

			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminthanks/edit/?id=<?php echo $model->id;?>",    
				data: jQuery('#thanks_form').serialize(),
				success: function(msg){	                        					  		
					  jQuery('#Thanks_sender').prev().remove();                                       						                                            					  	
					  jQuery('#Thanks_comment').prev().remove();
                                          jQuery('#Thanks_unit_id').prev().remove();
                                          jQuery('#Thanks_user_id').prev().remove();
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
                                                    if(data.Thanks_sender){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Thanks_sender);
                                                         $(div).insertBefore($('#Thanks_sender'));
                                                         
                                                    } 
                                                    if(data.Thanks_comment){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Thanks_comment);
                                                         $(div).insertBefore($('#Thanks_comment'));                                                         
                                                    }
                                                    if(data.Thanks_unit_id){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Thanks_unit_id);
                                                         $(div).insertBefore($('#Thanks_unit_id'));                                                         
                                                    }
                                                    if(data.Thanks_user_id){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Thanks_user_id);
                                                         $(div).insertBefore($('#Thanks_user_id'));                                                         
                                                    }
                                                }							  															
					else{                                           
                                                setCookie("thanks_edit_sender",$("#Thanks_sender").val());
                                                val=$("#Thanks_comment").val();
                                                val=val.replace(/\n/g, "<br/>");
                                                setCookie("thanks_edit_comment",val);
                                                setCookie("thanks_edit_unit_id",$("#Thanks_unit_id").val());
                                                setCookie("thanks_edit_user_id",$("#Thanks_user_id").val());
                                                jQuery('#thanks_form').submit();
                                        }							    			    
				}	  
			});			
		});                          
        });
</script>
