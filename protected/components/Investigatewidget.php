<?php
class Investigatewidget extends CWidget
{
	public function init()
	{

	}

	public function run()
	{
		$sql = "select * from investigate order by created_date desc limit 5";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $investigates = $command->queryAll();

        

        if (FunctionCommon::isViewFunction("investigate") == FALSE) {
            $investigates = array();
        }
        ?>
        

<h2 class="h2_chdt">Câu hỏi điều tra
                   
                    	
                        <?php
                if (FunctionCommon::isPostFunction("investigate") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/workinvestigate/regist" class="bt_dangtai"></a>';
                }
                ?>
                       
                   </h2>
         
                
            <ul>
                            <p class="notes">Bất cứ ai cũng có thể thực hiện một bảng câu hỏi trong công ty một cách tự do!</p>
           
<?php
        if (is_array($investigates) && count($investigates) > 0) {            
           
           
            for($i=0,$n=count($investigates);$i<$n;$i++){
            $investigate=$investigates[$i];                
                ?>                
                    <li>
                        <?php 
                        $level_array=  Config_investigate::$level_array;
                        if(is_array($level_array)&&count($level_array)>0){                                
                                foreach ($level_array as $key=>$value){
                                    if($key==$investigate['icon']){
                                        echo '<div class="n_group cl'.$key.'">'.$value.'</div>';
                                    }
                                    
                                }
                        }
                        ?>
                        <span class="textcl4 w80 ml10"><?php  echo FunctionCommon::formatDate($investigate['created_date']); ?></span>
                        
                        
                        
                        <a class="w280" href="<?php echo Yii::app()->baseUrl . '/workinvestigate/detail/?id='.$investigate['id'];?>">
                              <?php  echo FunctionCommon::crop(htmlspecialchars($investigate['title']), 35); ?>
                        </a>
                       
                    </li>
                    
                
                
                
<?php
            }
            
            
            
        }
        else{
                                    echo '<li><span class="textcl4 w80 ml10"></span><a href="" class="w280"></a></li>';                                 
                                    
                                }
        if (FunctionCommon::isViewFunction("investigate") == true) {
                            echo '<a href="'.Yii::app()->baseUrl.'/workinvestigate" class="viewmore4"></a>';
                                                      
                        }
        ?>
            </ul>
        
<?php
	}
}
