<?php
class Hrwidget extends CWidget

{
    
	public function init()
	{
	}

	public function run()
	{
		

		echo '<h2><span></span>Thông báo từ phòng hành chính nhân sự</h2>';
                echo '<ul>';
                echo '<p class="notes bg_yellow">';
                echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/join" class="link">Gia nhập</a>';
                echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/leave" class="link">Rời khỏi</a>';
                echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/change" class="link">Thay đổi</a>';
                //echo '<a class="bt" href=""></a>';
                echo '</p>';
                echo '<h2 style="background-color: #9A610E;text-align: center;text-transform: uppercase;font:700 12px arial;padding-top: 15px;border-radius: 5px;height: 30px;">Thông báo khác';
                if(FunctionCommon::isPostFunction("hr")==true){
			echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/regist" class="bt_dangtai" style="margin: 0px 10px 0px 0px;"></a>';		
		}
                echo '</h2>';
//		echo '<p class="notes bg_yellow">Thông báo khác</p>';
//		if(FunctionCommon::isPostFunction("hr")==true){
//			echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/regist" class="bt_dangtai"></a>';		
//		}
                
		
                
		
		if(FunctionCommon::isViewFunction("hr")==true)
		{
			
		$sql		=	"select * from hr order by created_date desc limit 5";
		$connection =	Yii::app()->db; 
		$command	=	$connection->createCommand($sql); 
		$hrs 		=	$command->queryAll();
		
		
		
				if(is_array($hrs)&&count($hrs)>0)
				{	
					foreach($hrs as $object){
?>
					<li>
                                            <span class="textcl1 w80"><?php echo FunctionCommon::formatDate($object['created_date']); ?></span>                                            
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/workhr/detail/?id=<?php echo $object['id']; ?>" class="w350">
                                            <?php echo FunctionCommon::crop(htmlspecialchars($object['title']),45); ?>
                                        </a>
                                            
                    
                    
                    </li>
                    
<?php
					}
				}
                                else{
                                    echo '<li><span class="textcl1 w80"></span><a href="" class="w350"></a></li>';                                 
                                    
                                }
		}
                else{
                                    echo '<li><span class="textcl1 w80"></span><a href="" class="w350"></a></li>';                                 
                                    
                                }
		
		
		if(FunctionCommon::isViewFunction("hr")==true)
		{
			echo '<a href="'.Yii::app()->request->baseUrl.'/workhr/" class="viewmore1"></a>';
		}
                echo '</ul>';
		
		
	}
}

