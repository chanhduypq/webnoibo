<?php
class Contributewidget extends CWidget

{
    
	public function init()
	{
	}

	public function run()
	{
		

		echo '<h2 class="h2_emailbox">Hòm thư góp ý ';			
		
		if(FunctionCommon::isPostFunction("contribute")==true){
			echo '<a href="'.Yii::app()->request->baseUrl.'/workcontribute/regist" class="bt_dangtai"></a>';		
		}
                echo '</h2>';		
		echo '<ul>';
                echo '<p class="notes">Nơi đặt câu hỏi, thắc mắc của nhân viên về Công ty</p>';
		
		if(FunctionCommon::isViewFunction("contribute")==true)
		{
			
		$sql		=	"select * from contribute order by created_date desc limit 5";
		$connection =	Yii::app()->db; 
		$command	=	$connection->createCommand($sql); 
		$contributes 		=	$command->queryAll();
		
		
		
				if(is_array($contributes)&&count($contributes)>0)
				{	
					foreach($contributes as $object){
?>
					<li>
                                            <span class="textcl1 w80"><?php echo FunctionCommon::formatDate($object['created_date']); ?></span>
                                            
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/workcontribute/detail/?id=<?php echo $object['id']; ?>" class="w380">
                                            <?php echo FunctionCommon::crop(htmlspecialchars($object['title']),90); ?>
                                        </a>
                                            
                    
                    
                    </li>
                    
<?php
					}
				}
                                else{
                                    echo '<li><span class="textcl1 w80"></span><a href="" class="w380"></a></li>';                                 
                                    
                                }
		}
                else{
                                    echo '<li><span class="textcl1 w80"></span><a href="" class="w380"></a></li>';                                 
                                    
                                }
		
		
		if(FunctionCommon::isViewFunction("contribute")==true)
		{
			echo '<a href="'.Yii::app()->request->baseUrl.'/workcontribute/" class="viewmore1"></a>';
		}
                echo '</ul>';
		
		
	}
}

