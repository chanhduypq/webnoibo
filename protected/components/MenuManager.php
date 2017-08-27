<?php
class MenuManager extends CWidget
{
	public function init()
	{
	}

	public function run()
	{
?>
		<dl class="menu main">
            <dt>Quản lý</dt>
            <dd class="admin"><a class="posts" href="<?php echo Yii::app()->baseUrl;?>/admin">admin</a></dd>
            
            <dd class="admin">
            <?php
				if(isset(Yii::app()->request->cookies['passwd'])&&Yii::app()->request->cookies['passwd']->value=='smile@gmorunsystem'){
			?>	
				<script type='text/javascript'>
				 $(document).ready(function(){
					$("a.profile").attr("href", "<?php echo Yii::app()->baseUrl;?>/adminprofile/detail/?id=<?php echo Yii::app()->request->cookies['id']->value;?>");
					});
				</script>
			<?php		
            }
            ?>
            <a class="profile" href="<?php echo Yii::app()->baseUrl;?>/adminprofile/detail/?id=<?php echo Yii::app()->request->cookies['id']->value;?>">profile</a></dd>
            <?php 
            
            if(FunctionCommon::isAdminFunction('unit')==true){?>
            <dd class="admin">
                <a class="unit" href="<?php echo Yii::app()->baseUrl;?>/adminunit/">Chi nhánh</a>	
            </dd>    
            <?php
            }
            if(FunctionCommon::isAdminFunction('post')==true){?>
            <dd class="admin">
                <a class="unit" href="<?php echo Yii::app()->baseUrl;?>/adminpost/">Bộ phận</a>	
            </dd>    
            <?php
            }
            ?>
 
        </dl>
<?php		
	}
}