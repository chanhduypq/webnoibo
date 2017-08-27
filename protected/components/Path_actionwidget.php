<?php

class Path_actionwidget extends CWidget 
{

    
    public $link_array;
    public $home_link;
    public function run() 
	{?>

        <div class="box_left">
            <div class="link_back">
                <ul>
                    <li><a href="<?php echo Yii::app()->request->baseUrl.$this->home_link; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/home_link_back.png"></a></li>
                    <?php
                    $link_array=  $this->link_array;
                   
                    
                        for ($i=0,$n=count($link_array);$i<$n;$i++){                            
                           
                            echo '<li><img src="'.Yii::app()->request->baseUrl.'/css/common/gmo/images/arrow_link_back.png"></li>';
                            if($i<$n-1){
                                echo '<li><a href="'.Yii::app()->request->baseUrl.$link_array[$i]['link'].'">'.$link_array[$i]['text'].'</a></li>';                                
                            }
                            else{                               
                                echo '<li>'.$link_array[$i]['text'].'</li>';
                            }
                            
                
                            
                        }
                    
                    ?>
                    
                </ul>
            </div>
        </div>

<?php
        }
    
    
    



}
?>




