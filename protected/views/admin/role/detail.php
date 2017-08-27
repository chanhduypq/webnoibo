<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<script>
    $(window).load(function(){
           $("body").attr('id','admin');
     });
</script>
<div class="wrapper secondary admin role">

    
        <div class="contents detail">
        	
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2>
                <span><a href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/" class="btn btn-important"><i class="icon-chevron-left icon-white"></i> <?php echo Config::TEXT_FOR_BACK_TO_LIST;?></a></span>
                <span><a href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/edit/?id=<?php echo $roles[0]->id; ?>" class="btn btn-work"><i class="icon-pencil icon-white"></i><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_DETAIL;?></a></span></div>
                <div class="box">
<!--                <p class="descriptionTxt">役割の権限など管理情報をご確認いただけます。</p>-->
                <div class="field attachements"><div class="title">
                  <?php echo $roles[0]->role_name ?>
                </div></div>
                <table width="724" border="0" class="table list font14">
                	<tr><th>Chức năng</th><th>Quyền</th></tr>
                    <?php
                      foreach($functions as $val){
                     ?>
                       <tr>
                            <td class="td-text">
                            <p class="text alnC"><?php echo htmlspecialchars($val->function_name) ?></p>
                            </td>
                            <td class="td-icon" style="width: 300px;">
                                <div class="btn-group" data-toggle="buttons-checkbox">
                                <?php if(isset($role_relative[$val->id]))
                                 {

                                 ?>
                                 <?php if($role_relative[$val->id]['view']==1){
                                    echo '<div style="float: left;" class="view_role">Xem</div>';
                     
                                 }
                                 if($role_relative[$val->id]['post']==1){
                                    echo '<div style="float: left;" class="post_role">Đăng tin</div>';
                     
                                 }
                                 if($role_relative[$val->id]['admin']==1){
                                    echo '<div style="float: left;" class="control_role">Quản trị</div>';
                     
                                 }
                                 }
                                 ?>
                                    <div style="clear: both;float: left;"></div>
                                 </div>
           					</td>
                        </tr>
                        <?php
                       
                        }
                        ?>
                   
                </table>
                
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

