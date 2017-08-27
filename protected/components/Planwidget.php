<?php
class Planwidget extends CWidget
{
	public function init()
	{

	}

	public function run()
	{
		$sql = "select * from plan order by created_date desc limit 5";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $plans = $command->queryAll();

        

        if (FunctionCommon::isViewFunction("plan") == FALSE) {
            $plans = array();
        }
        ?>
        

<h2 class="h2_dtht">Mục tiêu và hành động
                   
                    	
                        <?php
                if (FunctionCommon::isPostFunction("plan") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/workplan/regist" class="bt_dangtai"></a>';
                }
                ?>
                       
                   </h2>
         
                
            <ul>
                            <p class="notes">Kết quả Đạt/không đạt kế hoạch doanh thu hàng tháng của các nhóm</p>
           
<?php
        if (is_array($plans) && count($plans) > 0) {            
           
           
            for($i=0,$n=count($plans);$i<$n;$i++){
            $plan=$plans[$i];                
                ?>                
                    <li>
                        <?php 
                        $level_array=  Config_plan::$level_array;
                        if(is_array($level_array)&&count($level_array)>0){                                
                                foreach ($level_array as $key=>$value){
                                    if($key==$plan['icon']){
                                        echo '<div class="n_group cl'.$key.'">'.$value.'</div>';
                                    }
                                    
                                }
                        }
                        ?>
                        <span class="textcl4 w80 ml10"><?php  echo FunctionCommon::formatDate($plan['created_date']); ?></span>
                        
                        
                        
                        <a class="w280" href="<?php echo Yii::app()->baseUrl . '/workplan/detail/?id='.$plan['id'];?>">
                              <?php  echo FunctionCommon::crop(htmlspecialchars($plan['title']), 35); ?>
                        </a>
                       
                    </li>
                    
                
                
                
<?php
            }
            
            
            
        }
        else{
                                    echo '<li><span class="textcl4 w80 ml10"></span><a href="" class="w280"></a></li>';                                 
                                    
                                }
        if (FunctionCommon::isViewFunction("plan") == true) {
                            echo '<a href="'.Yii::app()->baseUrl.'/workplan" class="viewmore6"></a>';
                                                      
                        }
        ?>
            </ul>
        
<?php
	}
}
