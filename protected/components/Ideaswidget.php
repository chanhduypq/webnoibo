<?php
class Ideaswidget extends CWidget
{
	public function init()
	{
	}

	public function run()
	{
            

		
		echo '<h2 class="h2_ytuong">Ý tưởng mới';			
		
		if(FunctionCommon::isPostFunction("ideas")==true){
			echo '<a href="'.Yii::app()->request->baseUrl.'/workideas/regist" class="bt_dangtai"></a>';		
		}
                echo '</h2>';		
		echo '<ul>';
                echo '<p class="notes">Chúng ta hãy đóng góp những ý kiến sáng tạo, độc đáo ​​một cách tự do và thực hiện đánh giá lẫn nhau!</p>';
		
		if(FunctionCommon::isViewFunction("ideas")==true)
		{
			
		$sql		=	"select * from ideas order by created_date desc limit 5";
		$connection =	Yii::app()->db; 
		$command	=	$connection->createCommand($sql); 
		$ideas 		=	$command->queryAll();
		
		$sql_comment		=	"select * from ideas_comment";
		$connection_comment =	Yii::app()->db; 
		$command_comment	=	$connection_comment->createCommand($sql_comment); 
		$ideas_comments 		=	$command_comment->queryAll();
		
				if(!is_null($ideas))
				{	
					foreach($ideas as $object){
?>
					<li>
                                            <span class="textcl3 w80"><?php echo FunctionCommon::formatDate($object['created_date']); ?></span>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/workideas/detail/?id=<?php echo $object['id']; ?>" class="w380">
                                            <?php echo FunctionCommon::crop(htmlspecialchars($object['title']),90); ?>
                                        </a>
                                            
                    
                    <div class="bl">
                                <p>Bình luận: 
                                    <?php
											     $i = 0; 
												 $rating = 0;
												 foreach ($ideas_comments as $comment) {
													 if($object['id']==$comment['ideas_id']){ 
													 $i = $i+1;
													 $rating = $comment['valuation']+ $rating;
													 } 
												 }
												 echo $i;
									?>
                                    
                                </p>
                                 <?php 
												if($i!=0){
													$average = $rating/$i;
													$average = substr($average, 0, 3);
													if($average==0){$star = "star0"; $average=0;}
													else if($average > 0 && $average <= '1.5'){ $star = "star1";}
													else if($average > '1.5' && $average <= '2.5'){ $star = "star2";}
													else if($average > '2.5' && $average <= '3.5'){ $star = "star3";}
													else if($average > '3.5' && $average <= '4.5'){ $star = "star4";}
													else if($average > '4.5' ){ $star = "star5";}
														}
												else {$star = "star0"; $average=0;}
									?>
                                <p><span class="fl">Đánh giá: </span><span class="star <?php echo $star?>"></span></p>
                               
                            </div>
                    </li>
                    
<?php
					}
				}
		}
		
		
		if(FunctionCommon::isViewFunction("ideas")==true)
		{
			echo '<a href="'.Yii::app()->request->baseUrl.'/workideas/" class="viewmore3"></a>';
		}
                echo '</ul>';
		
		
	}
}