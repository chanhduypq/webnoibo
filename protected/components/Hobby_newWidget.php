<?php
class Hobby_newWidget extends CWidget
{
    
	public function init()
	{

	}
	
	public function run()
	{
		// SQL Query	
		$sql="select * from hobby_new order by created_date desc limit 3";
		// Define the DB connection for this page(to use your database first you have to remove the comment in code phrase in Config.php)
		$connection=Yii::app()->db; 
		// Execute the sql
		$command=$connection->createCommand($sql); 
		$hobby_new=$command->queryAll();

		
		  
		
		if(FunctionCommon::isViewFunction("hobby_new"))
		{ 
                    echo '<ul class="list_tinmoi">';
                    if(is_array($hobby_new)&&count($hobby_new)>0){
                        foreach($hobby_new as $object)
			{
				echo '<li>';	
                                echo '<a href="'.Yii::app()->request->baseUrl.'/playhobby_new/detail?id='.$object['id'].'">';	
                                echo FunctionCommon::crop(htmlspecialchars($object["title"]),60);			
				echo '<span>('.FunctionCommon::formatDate($object['created_date']).')</span>';
                                echo '</a>';
				echo '</li>';
			}
                    }			
                    echo '</ul>';
		}
		
	}
}