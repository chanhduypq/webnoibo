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
        $link_array[]=array("text"=>"Gia nhập","link"=>'/workhr/join') ; 
        $link_array[]=array("text"=>  Config::TEXT_FOR_ADD_IN_LINK_BACK_DIV,"link"=>'/workhr/join_regist') ; 
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
                        <a class="btn btn-important" href="<?php echo Yii::app()->request->baseUrl; ?>/workhr/join<?php echo $page;?>">
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
                        <label class="control-label" for="join_date">Ngày gia nhập&nbsp;
                        <span class="label label-warning"><?php echo Config::TEXT_FOR_INPUT_REQUIREMENT;?></span></label>
                        <div class="controls">
                        	
                        	<?php echo $form->textField($model, 'join_date', array('placeholder' => "Vui lòng nhập ngày gia nhập", 'class' => 'input-large')); ?>
                        </div>
                    </div>
                    <h4>Gia nhập đến</h4>
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
												echo $form->dropDownList($model,'unit',$array_unit,  array('prompt'=>'Chọn chi nhánh' , 'class' => 'input-xxlarge')); 											                                
												?> 											 
                                                                        	
                                        </div>
                                    </div>
        
                                    <div class="control-group">
                                        <label class="control-label" for="post1">Bộ phận&nbsp;
                                            
                                        </label>
                                        <div class="controls">
                                            <?php echo $form->dropDownList($model, 'position', $model->allPosts, array('options' => array($model->position => array('selected' => true)), 'class' => 'input-large')); ?> 
                   
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
            $( "input#Join_join_date" ).datepicker({
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
        
            
            
            $("#Join_position").click(function() {
                options=$("#Join_position option");
                if(options.length==1&&$("#Join_unit").val()==""){
                    alert("Vui lòng chọn Chi nhánh trước");
                }
            });
            $("#Join_unit").change(function() {
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
                                     jQuery('#Join_position').html("");
                                     jQuery('#Join_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Join_position').append("<option value=" + users[i].id + ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                
				
                
           }); 
           
           $("#Join_position").change(function() {
               
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
            
        
          $("#hr_form").attr('action','<?php echo Yii::app()->baseUrl;?>/workhr/join_registconfirm/');       	   
		 
		      
           title=getCookie("hr_join_regist_member_name");
           if(title!=null&&title!="null"){
               $("#Join_member_name").val(title);
           }
           join_date=getCookie("hr_join_regist_join_date");
           if(join_date!=null&&join_date!="null"){
               $( "input#Join_join_date" ).datepicker('setDate', join_date);
               
           }
           else{
               $( "input#Join_join_date" ).datepicker('setDate', new Date());
           }
		   
           detail=getCookie("hr_join_regist_detail");           
           if(detail!=null&&detail!="null"){
                detail1=detail.replace(/<br ?\/?>|_/g, '\n');
               $("#Join_detail").val(detail1);
           }
           division=getCookie("hr_join_regist_unit");
           if(division!=null&&division!="null"){
           $("#Join_unit").val(division);
           position=getCookie("hr_join_regist_position");
           $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getposts/?unit_id="+division,    				
				success: function(msg){	 
                                     users=$.parseJSON(msg);
                                     jQuery('#Join_position').html("");
                                     jQuery('#Join_position').append("<option value=''>Chọn bộ phận</option>");
                                    for (i = 0,n=users.length; i <n; i++) {
                                        jQuery('#Join_position').append("<option value='" + users[i].id+"'" +(users[i].id==position?' selected':'')+ ">" + users[i].post_name + "</option>");
                                    }    
                                }
                });
                if(position!=null&&position!="null"){
                $.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/adminuser/getpost/?post_id="+position,    				
				success: function(msg){
                                      users=$.parseJSON(msg);
                                      
                                    for (i = 0,n=users.length; i <n; i++) {
                                        
                                        $("input#post_name").val(users[i].post_name);
                                        
                                    }   
                                     
                                }
                });
                }
       }
           
		   
		  
           setCookie("hr_join_regist_member_name",$("#Join_member_name").val());
           setCookie("hr_join_regist_detail",detail); 
           
            /**
             * 
             */
           $("body").attr('id','work');      
        
           $('button[type="submit"]').click(function(){  
    
            deleteCookies("hr_join_regist_from"); 		   
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/workhr/join_regist/",    
				data: jQuery('#hr_form').serialize(),
				success: function(msg){	           
					  	             					  		
					  jQuery('#Join_member_name').prev().remove();                                       				                  					
					  jQuery('#Join_detail').prev().remove();       
                                          jQuery('#Join_join_date').prev().remove();       
					  	if(msg!='[]'){
                                                    data=$.parseJSON(msg);
													
													
                                                    if(data.Join_member_name){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Join_member_name);
                                                         $(div).insertBefore($('#Join_member_name'));
                                                         
                                                    } 
                                                    if(data.Join_detail){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Join_detail);
                                                         $(div).insertBefore($('#Join_detail'));                                                         
                                                    }
                                                    if(data.Join_join_date){
                                                         div=document.createElement('div');
                                                         $(div).addClass('alert');
                                                         $(div).addClass('error_message');
                                                         $(div).html(data.Join_join_date);
                                                         $(div).insertBefore($('#Join_join_date'));                                                         
                                                    }
                                                }							  															
					else{                               
												 
												
                                                setCookie("hr_join_regist_member_name",$("#Join_member_name").val());
                                                
                                                val=$("#Join_detail").val();
                                                val=val.replace(/\n/g, "<br/>");
                                                setCookie("hr_join_regist_detail",val);
                                                setCookie("hr_join_regist_unit",$("#Join_unit").val());
                                               setCookie("hr_join_regist_position",$("#Join_position").val());
                                               setCookie("hr_join_regist_join_date",$("#Join_join_date").val());
                                                if($("#Join_position").val()==""){
                                                    $("input#post_name").val("");
                                                }
                                                jQuery('#hr_form').submit();
                                            
                                            
                                        }							    			    
				}	  
			});			
		});                        
        });
		

</script>