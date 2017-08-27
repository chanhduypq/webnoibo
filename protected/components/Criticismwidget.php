<?php
class Criticismwidget extends CWidget

{
    
	public function init()
	{
	}

	public function run()
	{
		

		echo '<h2 class="h2_vbqd">các văn bản &amp; quyết định ';			
		
		if(FunctionCommon::isPostFunction("criticism")==true){
			echo '<a href="'.Yii::app()->request->baseUrl.'/workcriticism/regist" class="bt_dangtai"></a>';		
		}
                echo '</h2>';		
		echo '<ul>';
                echo '<p class="notes">Tất cả những văn bản quyết định liên quan đến công ty</p>';
		
		if(FunctionCommon::isViewFunction("criticism")==true)
		{
			
		$sql		=	"select * from criticism order by created_date desc limit 5";
		$connection =	Yii::app()->db; 
		$command	=	$connection->createCommand($sql); 
		$criticisms 		=	$command->queryAll();
		
		
		
				if(is_array($criticisms)&&count($criticisms)>0)
				{	
					foreach($criticisms as $object){
?>
					<li>
                                            <span class="textcl2 w80"><?php echo FunctionCommon::formatDate($object['created_date']); ?></span>
                                            <?php
                                            $icon= FunctionCommon::get_icon_for_criticism($object['attachment1'], $object['attachment2'], $object['attachment3']);
                                            if($icon!=""){
                                                echo '<img src="'.Yii::app()->request->baseUrl.'/css/common/gmo/images/'.$icon.'.gif"/>';                                                
                                            }
                                            ?>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/workcriticism/detail/?id=<?php echo $object['id']; ?>" class="w350">
                                            <?php echo FunctionCommon::crop(htmlspecialchars($object['title']),90); ?>
                                        </a>
                                            
                    
                    
                    </li>
                    
<?php
					}
				}
                                else{
                                    echo '<li><span class="textcl2 w80"></span><a href="" class="w350"></a></li>';                                 
                                    
                                }
		}
                else{
                                    echo '<li><span class="textcl2 w80"></span><a href="" class="w350"></a></li>';                                 
                                    
                                }
		
		
		if(FunctionCommon::isViewFunction("criticism")==true)
		{
			echo '<a href="'.Yii::app()->request->baseUrl.'/workcriticism/" class="viewmore3"></a>';
		}
                echo '</ul>';
		
		
	}
}

