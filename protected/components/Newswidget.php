<?php

class Newswidget extends CWidget {
    

    public function init() {        
    }
    public function run() {
        $sql = "select * from news order by created_date desc limit 4";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $coffees = $command->queryAll();


        if (FunctionCommon::isViewFunction("news") == FALSE) {
            $coffees = array();
        }
        ?>
            <h2 class="green">
                <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/new_icon.png">ĐỌC NGAY NHÉ</span>
                
                    <?php
                    $count=Yii::app()->db->createCommand("select count(*) as count from news where id not in (select news_id from news_read where user_id=".Yii::app()->request->cookies['id']->value.")")->queryScalar();
                    
                    if($count==0){
                        echo '<a class="noti">';
                    }
                    else{
                        echo '<a href="'.Yii::app()->baseUrl.'/playnews/unread" class="noti">';
                    }
                    echo $count;
                    echo '</a>';
                    ?>
                
            </h2>
            <ul class="list_tin">
<?php
        if (is_array($coffees) && count($coffees) > 0) {    
            foreach ($coffees as $coffee) {?>
                
                    <li><a href="<?php echo Yii::app()->baseUrl . '/playnews/detail/?id='.$coffee['id'];?>">
                        <?php  echo FunctionCommon::crop(htmlspecialchars($coffee['title']), 30); ?> 
                        </a>
                    </li>
                    
                
                
                
<?php

            }
        }
            ?>
            </ul>
<?php
        
    }

}
