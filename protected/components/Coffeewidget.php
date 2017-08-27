<?php

class Coffeewidget extends CWidget {

    public function init() {        
    }
    public function run() {
        $sql = "select * from coffee order by created_date desc limit 4";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $coffees = $command->queryAll();


        if (FunctionCommon::isViewFunction("coffee") == FALSE) {
            $coffees = array();
        }
        if (is_array($coffees) && count($coffees) > 0) {
            $i=1;
            foreach ($coffees as $coffee) {?>
                <div class="box_coffee">
                    <div class="stt"><?php echo $i;?></div>
                    <div class="txt_coffee">
                        <a href="<?php echo Yii::app()->baseUrl . '/playcoffee/detail/?id='.$coffee['id'];?>">
                            <?php  echo FunctionCommon::crop(htmlspecialchars($coffee['title']), 76); ?>
                        </a>
                        <span class="time"><?php echo FunctionCommon::formatDate($coffee['created_date']);?></span>
                    </div>
                </div>
                
<?php
$i++;
            }
        }
    }

}
