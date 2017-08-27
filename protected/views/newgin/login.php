<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery.numeric.js"></script>
<?php

if(Yii::app()->request->cookies['id'] !=NULL){
		$index_work="work";
		echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='".$index_work."';</SCRIPT>");
}
else {
?>

<div class="container">
	<div class="wrapper login">
    	<div class="mainBox detail">
         
            <div class="pageTtl"><h2>Đăng nhập</h2></div>
            <div class="box">
            <p class="descriptionTxt">Vui lòng nhập ID nhân viên và mật khẩu.</p>
             
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login_form',  
					//'enableClientValidation'=>true,
					'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),                   
                    'htmlOptions' => array(
                                       	 
                                          'class'=>'form-horizontal',
                                         
                                          ),
                     ));
			?>	
                <div class="cnt-box">
                  <?php
                  if(isset($error)&&$error==TRUE){
                      echo '<div class="alert error_message">Thông tin đăng nhập không chính xác</div>';
                  }
                  ?>
                    
                  <div class="control-group">
                    <label for="staff_id" class="control-label">ID nhân viên</label>
                    <div class="controls">
                                          <input type="text" maxlength="20" id="LoginForm_employee_number" name="LoginForm[employee_number]" class="input-xxlarge" placeholder="Vui lòng nhập ID nhân viên">
                    </div>
                  </div>
                  <div class="control-group">
                    <label for="staff_pw" class="control-label">Mật khẩu</label>
                    <div class="controls">
                                         <input type="password" maxlength="20" id="LoginForm_passwd" name="LoginForm[passwd]" class="input-xxlarge" placeholder="Vui lòng nhập mật khẩu">                   </div>
                  </div>
                  
                </div><!-- /cnt-box -->
                <?php $this->endWidget(); ?>
                <div class="form-last-btn">
                  <p class="btn90">
                    <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white"></i> Đăng nhập</button>
                  </p>
                </div>
                <p class="mt20 alnC">
                    <a onclick="alert('Chức năng này chưa được thực hiện')" class="forgetpass"><i class="icon-question-sign"></i><span>Quên mật khẩu</span></a>
<!--                    <a href="/newgin/pw" class="forgetpass"><i class="icon-question-sign"></i><span>Quên mật khẩu</span></a>-->
                </p>
            
            </div><!-- /box -->
            </div>
    </div>
</div>



<script type="text/javascript"> 
    
		
		jQuery(function($) {       
                    $("#LoginForm_employee_number").keypress(function (e){
                        if(e.which == 13) {
                            submit();
//                            if($.trim($(this).val())!=""){
//                                $("#LoginForm_passwd").focus();
//                            }
                        }
                        
                    });
                    $("#LoginForm_passwd").keypress(function (e){
                        if(e.which == 13) {
                            submit();
//                            if($(this).val()!=""){
//                                $("#LoginForm_employee_number").focus();
//                            }
                        }
                        
                    });
                    function submit(){
                        $("#LoginForm_employee_number").html("");		
			$("#LoginForm_passwd").html("");	
			$("#LoginForm_employee_number").removeClass("cerrorMessage alert error_message");		
			$("#LoginForm_passwd").removeClass("cerrorMessage alert error_message");
                        $("div#error_login").removeClass('alert');
                         $("div#error_login").removeClass('error_message');
                         $("div#error_login").html("");
											
			$.ajax({    
				type: "POST", 
				async:true,
				url: "<?php echo Yii::app()->baseUrl;?>/",    
				data: jQuery('#login_form').serialize(),
				success: function(msg){	                        
					    jQuery('#login_form input').prev().remove();
					  	if(msg!='[]'){
									
									data=$.parseJSON(msg);
									if(data.LoginForm_employee_number){
										 div=document.createElement('div');
										 $(div).addClass('alert');
										 $(div).addClass('error_message');
                                                                                 $(div).html(data.LoginForm_employee_number);
										 $(div).insertBefore($('#LoginForm_employee_number')); 
									} 
									if(data.LoginForm_passwd){
                                                                            div=document.createElement('div');
										 $(div).addClass('alert');
										 $(div).addClass('error_message');
                                                                                 $(div).html(data.LoginForm_passwd);
										 $(div).insertBefore($('#LoginForm_passwd')); 
                                                                            
										 
									} 	
					  	}
                                                else{
                                                    jQuery('#login_form').submit();
                                                }
						
				}	  
			});
                    }
     	   $("body").attr('id','login');     
   		 $('#LoginForm_employee_number').numeric(false, function() { this.value = ""; this.focus(); });//           	
           $('button[type="submit"]').click(function(){ 
		 submit();
			
			
		});    
           
            
        });
</script>
<?php }?>