<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui-1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"  media="screen"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui-1.10.3/ui/jquery-ui.js"></script>                
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui-1.10.3/ui/minified/jquery.ui.datepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui-1.10.3/ui/i18n/jquery.ui.datepicker-vi.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui-1.10.3/ui/jquery.ui.effect-explode.js"></script>
<div class="wrapper secondary">
    
        <div class="contents regist">    
<?php
        	$home_link='/work';
        $link_array=array();
        $link_array[]=array("text"=>"Thông báo từ phòng hành chính nhân sự","link"=>'/workhr') ; 
        $link_array[]=array("text"=>"Thay đổi","link"=>'/workhr/change') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/workhr/change_regist') ; 
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>             
            <div class="mainBox detail">
            	<div class="pageTtl">
                    <h2></h2>
                    <span>
						 <?php 
                        if(Yii::app()->request->cookies['page']!= NULL) 
                        {
                               $page = "?page=".Yii::app()->request->cookies['page']->value;
                                
                        }else {$page ="";}
                        ?>
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/workhr/change<?php echo $page;?>">
                            <i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?>
                        </a>
                    </span>
                </div>
                <div class="box">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'hr_form',                     
                    'htmlOptions' => array(
                                          'enctype' => 'multipart/form-data',
                                          'class'=>'form-horizontal',                                         
                                          ),
                        ));
                ?> 
                    <input type="hidden" name="post_name" id="post_name"/>
                    <input type="hidden" name="to_post_name" id="to_post_name"/>
                <div class="cnt-box">     
			<h4></h4>		
                    <div class="control-group">
                        <label class="control-label" for="member_name">Tên thành viên&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	
                        	<?php echo $form->textField($model, 'member_name', array('placeholder' => "Vui lòng nhập tên thành viên", 'class' => 'input-xxlarge')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="change_date">Ngày thay đổi&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	
                        	<?php echo $form->textField($model, 'change_date', array('placeholder' => "Vui lòng nhập ngày gia nhập", 'class' => 'input-large')); ?>
                        </div>
                    </div>
                    <h4>Thay đổi</h4>
                    <div>Từ</div>
                    <div class="control-group">
                                        <label class="control-label" for="department1">Chi nhánh&nbsp;
                                        
                                        </label>
                                        <div class="controls">
                                              <?php 
											  	
													echo "<div id='error_message_division1'></div>";	
																								
												$array_unit = array();
												foreach ($unit as $unit_name){
													  
													   $array_unit[$unit_name['id']] = $unit_name['unit_name'];
													   
												}
												echo $form->dropDownList($model,'from_unit',$array_unit,  array('prompt'=>'Chọn chi nhánh' , 'class' => 'input-xxlarge')); 											                                
												?> 											 
                                                                        	
                                        </div>
                                    </div>
        
                                    <div class="control-group">
                                        <label class="control-label" for="post1">Bộ phận&nbsp;
                                            
                                        </label>
                                        <div class="controls">
                                            <?php echo $form->dropDownList($model, 'from_position', $model->allPosts, array('options' => array($model->from_position => array('selected' => true)), 'class' => 'input-large')); ?> 
                   
                                        </div>
                                    </div>
                    <div>Đến</div>
                    <div class="control-group">
                                        <label class="control-label" for="department1">Chi nhánh&nbsp;
                                        
                                        </label>
                                        <div class="controls">
                                              <?php 
											  	
													echo "<div id='error_message_division1'></div>";	
																								
												$array_unit = array();
												foreach ($unit as $unit_name){
													  
													   $array_unit[$unit_name['id']] = $unit_name['unit_name'];
													   
												}
												echo $form->dropDownList($model,'to_unit',$array_unit,  array('prompt'=>'Chọn chi nhánh' , 'class' => 'input-xxlarge')); 											                                
												?> 											 
                                                                        	
                                        </div>
                                    </div>
        
                                    <div class="control-group">
                                        <label class="control-label" for="post1">Bộ phận&nbsp;
                                            
                                        </label>
                                        <div class="controls">
                                            <?php echo $form->dropDownList($model, 'to_position', $model->allPosts, array('options' => array($model->from_position => array('selected' => true)), 'class' => 'input-large')); ?> 
                   
                                        </div>
                                    </div>
                    <h4></h4>
                    <div class="control-group">
                        <label class="control-label" for="detail">Ghi chú&nbsp;
                        </label>
                        <div class="controls">
                        	
                        	<?php echo $form->textarea($model, 'detail', array('placeholder' => 'Vui lòng nhập ghi chú', 'class' => 'input-xxlarge', 'rows' => 7,'maxlength' => 3000)); ?>
                        </div>
                    </div>
                    
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                    <div class="form-last-btn">
                        <p class="btn80">
                            <button class="btn btn-important" type="submit">
								<i class="icon-chevron-right icon-white">&#12288;</i> <?php echo Config::TEXT_FOR_NEXT_IN_PAGE_REGIST;?>
							</button>
                        </p>
                        
                    </div> 
                
                </div><!-- /box -->
            </div><!-- /mainBox -->
            
        </div><!-- /contents -->
        

</div>
<script type="text/javascript"> 
        jQuery(function($){ 
            $( "input#Change_change_date" ).datepicker({
                "dateFormat":"dd/mm/yy",                
                "option":$.datepicker.regional['vi'],
                "showAnim":"explode",
                showOn: "button",
                buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/css/common/images/calendar/calendar.gif",
                buttonImageOnly: true,
                buttonText: 'Click để chọn ngày',
                showWeek: true,																
                changeMonth: true,
                changeYear: true                
        });
        
            
            
            $("#Change_from_position").click(function() {
                options=$("#Change_from_position option");
                if(options.length==1&&$("#Change_from_unit").val()==""){
                    alert("Vui lòng chọn Chi nhánh trước");
                }
            });
            $("#Change_to_position").click(function() {
                options=$("#Change_to_position option");
                if(options.length==1&&$("#Change_to_unit").val()==""){
                    alert("Vui lòng chọn Chi nhánh trước");
                }
            });
            $("#Change_from_unit").change(function() {
            var str_id=$(this).val();
            if(str_id==''){
                str_id='-1';
            }
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+str_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Change_from_position').html("");
                                     jQuery('#Change_from_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Change_from_position').append("<option value=" + users[i].id + ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                
				
                
           }); 
           $("#Change_to_unit").change(function() {
            var str_id=$(this).val();
            if(str_id==''){
                str_id='-1';
            }
            
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+str_id,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Change_to_position').html("");
                                     jQuery('#Change_to_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Change_to_position').append("<option value=" + users[i].id + ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                
				
                
           });
           
           $("#Change_from_position").change(function() {
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+$(this).val(),    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                
           }); 
           $("#Change_to_position").change(function() {
               
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+$(this).val(),    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#to_post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                
           });
            
        
          $("#hr_form").attr('action','<?php echo Yii::app()->baseUrl;?>/workhr/change_registconfirm/');       	   
		 
		      
           title=getCookie("hr_change_regist_member_name");
           if(title!=null&&title!="null"){
               $("#Change_member_name").val(title);
           }
           change_date=getCookie("hr_change_regist_change_date");
           if(change_date!=null&&change_date!="null"){
               $( "input#Change_change_date" ).datepicker('setDate', change_date);
               
           }
           else{
               $( "input#Change_change_date" ).datepicker('setDate', new Date());
           }
		   
           detail=getCookie("hr_change_regist_detail");           
           if(detail!=null&&detail!="null"){
                detail1=detail.replace(/<br ?\/?>|_/g, '\n');
               $("#Change_detail").val(detail1);
           }
           division=getCookie("hr_change_regist_from_unit");
           if(division!=null&&division!="null"){
           $("#Change_from_unit").val(division);
           from_position=getCookie("hr_change_regist_from_position");
           $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+division,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Change_from_position').html("");
                                     jQuery('#Change_from_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Change_from_position').append("<option value='" + users[i].id+"'" +(users[i].id==from_position?' selected':'')+ ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                if(from_position!=null&&from_position!="null"){
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+from_position,    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                }
       }
       
       division1=getCookie("hr_change_regist_to_unit");
           if(division1!=null&&division1!="null"){
           $("#Change_to_unit").val(division1);
           to_position=getCookie("hr_change_regist_to_position");
           $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+division1,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Change_to_position').html("");
                                     jQuery('#Change_to_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Change_to_position').append("<option value='" + users[i].id+"'" +(users[i].id==to_position?' selected':'')+ ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                if(to_position!=null&&to_position!="null"){
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+to_position,    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#to_post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                }
       }
           
		   
		  
           setCookie("hr_change_regist_member_name",$("#Change_member_name").val());
           setCookie("hr_change_regist_detail",detail); 
           
            /**
             * 
             */
           $("body").attr('id','work');      
        
           $('button[type="submit"]').click(function(){  
    
            deleteCookies("hr_change_regist_from"); 		   
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/workhr/change_regist/",    
				data: jQuery('#hr_form').serialize(),
				success: function(msg){	           
					  	             					  		
					  jQuery('#Change_member_name').prev().remove();                                       				                  					
					  jQuery('#Change_detail').prev().remove();       
                                          jQuery('#Change_change_date').prev().remove();       
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
													
													
                                                    if(data.Change_member_name){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Change_member_name);
                                                         $(div).insertBefore($('#Change_member_name'));
                                                         
                                                    } 
                                                    if(data.Change_detail){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Change_detail);
                                                         $(div).insertBefore($('#Change_detail'));                                                         
                                                    }
                                                    if(data.Change_change_date){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Change_change_date);
                                                         $(div).insertBefore($('#Change_change_date'));                                                         
                                                    }
                                                }							  															
					else{                               
												 
												
                                                setCookie("hr_change_regist_member_name",$("#Change_member_name").val());
                                                
                                                val=$("#Change_detail").val();
                                                val=val.replace(/\n/g, "<br/>");
                                                setCookie("hr_change_regist_detail",val);
                                                setCookie("hr_change_regist_from_unit",$("#Change_from_unit").val());
                                               setCookie("hr_change_regist_from_position",$("#Change_from_position").val());
                                               setCookie("hr_change_regist_to_unit",$("#Change_to_unit").val());
                                               setCookie("hr_change_regist_to_position",$("#Change_to_position").val());
                                               setCookie("hr_change_regist_change_date",$("#Change_change_date").val());
                                                if($("#Change_from_position").val()==""){
                                                    $("input#post_name").val("");
                                                }
                                                if($("#Change_to_position").val()==""){
                                                    $("input#to_post_name").val("");
                                                }
                                                jQuery('#hr_form').submit();
                                            
                                            
                                        }							    			    
				}	  
			});			
		});                        
        });
		

</script>