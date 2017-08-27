<?php
class Itcontestwidget extends CWidget

{
    
	public function init()
	{
	}

	public function run()
	{
		

		echo '<h2 class="h2_itcontest">IT contest  ';			
		
		if(FunctionCommon::isPostFunction("itcontest")==true){
			echo '<a href="'.Yii::app()->request->baseUrl.'/workitcontest/regist" class="bt_dangtai"></a>';		
		}
                echo '</h2>';		
		echo '<ul>';
                echo '<p class="notes">Đóng góp ý kiến về cuộc thi IT Contest</p>';
		
		if(FunctionCommon::isViewFunction("itcontest")==true)
		{
			
		$sql		=	"select * from itcontest order by created_date desc limit 5";
		$connection =	Yii::app()->db; 
		$command	=	$connection->createCommand($sql); 
		$itcontests 		=	$command->queryAll();
		
		
		
				if(is_array($itcontests)&&count($itcontests)>0)
				{	
					foreach($itcontests as $object){
?>
					<li>
                                            <span class="textcl5 w80"><?php echo FunctionCommon::formatDate($object['created_date']); ?></span>
                                            
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/workitcontest/detail/?id=<?php echo $object['id']; ?>" class="w380">
                                            <?php echo FunctionCommon::crop(htmlspecialchars($object['title']),90); ?>
                                        </a>
<!--                                            <div class="bl textcl4">Hạn chót: <em>12/3/2014</em></div>-->
                                            
                    
                    
                    </li>
                    
<?php
					}
				}
                                else{
                                    echo '<li><span class="extcl5 w80"></span><a href="" class="w380"></a></li>';                                 
                                    
                                }
		}
                else{
                                    echo '<li><span class="extcl5 w80"></span><a href="" class="w380"></a></li>';                                 
                                    
                                }
		
		
		if(FunctionCommon::isViewFunction("itcontest")==true)
		{
			echo '<a href="'.Yii::app()->request->baseUrl.'/workitcontest/" class="viewmore3"></a>';
		}
                echo '</ul>';
		
		
	}
}

