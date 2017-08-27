<?php
class Noticewidget extends CWidget
{
	public function init()
	{

	}

	public function run()
	{
		$sql = "select * from notice order by created_date desc limit 10";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $notices = $command->queryAll();

        

        if (FunctionCommon::isViewFunction("notice") == FALSE) {
            $notices = array();
        }
        ?>
        
<div class="title">
                	<h3><span>Thông báo</span> nội bộ</h3>
                    <div class="bt">
                    	<?php 
                        if (FunctionCommon::isViewFunction("notice") == true) {
                            echo '<a href="'.Yii::app()->baseUrl.'/worknotice" class="viewmore_green"></a>';
                            $count=Yii::app()->db->createCommand("select count(*) as count from notice where id not in (select notice_id from notice_read where user_id=".Yii::app()->request->cookies['id']->value.")")->queryScalar();
                    
                            if($count==0){
                                echo '<a class="unread">';
                            }
                            else{
                                echo '<a href="'.Yii::app()->baseUrl.'/worknotice/unread" class="unread">';
                            }
                            echo $count;
                            echo '</a>';                           
                        }
                        ?>
                        <?php
                if (FunctionCommon::isPostFunction("notice") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/worknotice/regist" class="post"></a>';
                }
                ?>
                       
                    </div>
                </div>
                
            <div class="notice">
                	<p class="notes">Chia sẻ, hỏi đáp, xin trợ giúp của các team trong công ty</p>
           
<?php
        if (is_array($notices) && count($notices) > 0) { 
            $ul1_count=  ceil(count($notices)/2);            
            $i=1;
            $n=count($notices);
            echo '<ul>';
            for($i=0;$i<$ul1_count;$i++){
            $notice=$notices[$i];                
                ?>                
                    <li>
                        <?php 
                        $team_array=  Config_team_notice::$team_array;
                        if(is_array($team_array)&&count($team_array)>0){                                
                                foreach ($team_array as $key=>$value){
                                    if($key==$notice['icon']){
                                        echo '<div class="n_group cl'.$key.'">'.$value.'</div>';
                                    }
                                    
                                }
                        }
                        ?>
                        <span><?php  echo FunctionCommon::formatDate($notice['created_date']); ?></span>
                        
                        
                        
                        <a href="<?php echo Yii::app()->baseUrl . '/worknotice/detail/?id='.$notice['id'];?>">
                              <?php  echo FunctionCommon::crop(htmlspecialchars($notice['title']), 90); ?>
                        </a>
                       
                    </li>
                    
                
                
                
<?php
            }
            echo '</ul>';
            echo '<ul>';
            for($i=$ul1_count;$i<count($notices);$i++){
            $notice=$notices[$i];                
                ?>                
                    <li>
                        <?php 
                        $team_array=  Config_team_notice::$team_array;
                        if(is_array($team_array)&&count($team_array)>0){                                
                                foreach ($team_array as $key=>$value){
                                    if($key==$notice['icon']){
                                        echo '<div class="n_group cl'.$key.'">'.$value.'</div>';
                                    }
                                    
                                }
                        }
                        ?>
                        <span><?php  echo FunctionCommon::formatDate($notice['created_date']); ?></span>
                        
                        
                        
                        <a href="<?php echo Yii::app()->baseUrl . '/worknotice/detail/?id='.$notice['id'];?>">
                              <?php  echo FunctionCommon::crop(htmlspecialchars($notice['title']), 90); ?>
                        </a>
                       
                    </li>
                    
                
                
                
<?php
            }
            echo '</ul>';
            
        }
        echo '</div>';

	}
}
