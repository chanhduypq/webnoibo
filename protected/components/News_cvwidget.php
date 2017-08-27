<?php

class News_cvwidget extends CWidget {
    

    public function init() {        
    }
    public function run() {
        $sql = "select * from news_cv order by created_date desc limit 5";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $news_cvs = $command->queryAll();


        if (FunctionCommon::isViewFunction("news_cv") == FALSE) {
            $news_cvs = array();
        }
        ?>
        <h2>
            Đọc ngay nhé
            <?php
                if (FunctionCommon::isPostFunction("news_cv") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/worknews_cv/regist" class="bt_dangtai1"></a>';
                }
                ?>
        </h2>
                <div class="title">
                	<h3><span>Tin</span> mới nhất</h3>
                    <div class="bt">
                        <?php 
                        if (FunctionCommon::isViewFunction("news_cv") == true) {
                            echo '<a href="'.Yii::app()->baseUrl.'/worknews_cv" class="viewmore_green"></a>';
                            $count=Yii::app()->db->createCommand("select count(*) as count from news_cv where id not in (select news_cv_id from news_read_cv where user_id=".Yii::app()->request->cookies['id']->value.")")->queryScalar();
                    
                            if($count==0){
                                echo '<a class="unread">';
                            }
                            else{
                                echo '<a href="'.Yii::app()->baseUrl.'/worknews_cv/unread" class="unread">';
                            }
                            echo $count;
                            echo '</a>';                           
                        }
                        ?>
                    	
                    </div>
                </div>
            
            <ul class="news_est">
<?php
        if (is_array($news_cvs) && count($news_cvs) > 0) {    
            foreach ($news_cvs as $news_cv) {?>
                
                    <li>
                        <a href="<?php echo Yii::app()->baseUrl . '/worknews_cv/detail/?id='.$news_cv['id'];?>">
                              <?php $this->echo_img($news_cv['attachment1'], $news_cv['attachment1'], $news_cv['attachment1']); ?>
                        </a>
                        <p><a href="<?php echo Yii::app()->baseUrl . '/worknews_cv/detail/?id='.$news_cv['id'];?>">
                                <?php  echo FunctionCommon::crop(htmlspecialchars($news_cv['title']), 90); ?> 
                            </a></p>
                            <em>
                                <?php  echo FunctionCommon::formatDate($news_cv['created_date']); ?>
                            </em>
                            <p>
                                <?php  echo FunctionCommon::crop(nl2br(htmlspecialchars($news_cv['content'])), 250); ?> 
                            </p>
                    </li>
                    
                
                
                
<?php

            }
        }
            ?>
            </ul>
<?php
        
    }
    private function  echo_img($attachment1,$attachment2,$attachment3){        
        if($attachment1!=""){
            $extension=  strtolower(FunctionCommon::getExtensionFile($attachment1));
            if(in_array($extension, Constants::$imgExtention)){                
                $url = ltrim($attachment1, '/');
                list($width_orig, $height_orig) = getimagesize($url);                
                if($width_orig>136){
                    $width=136;
                }
                else{
                    $width=$width_orig;
                }
                $height= ceil($height_orig*$width/$width_orig);
                if($height>87){
                    $height=87;
                    $ratio=$width_orig/$height_orig;
                    $width= ceil($height*$ratio);
                }
                if(136>=$width){
                    $margin_right=136-$width;
                }
                else{
                    $margin_right=0;
                }
                echo '<img style="margin-right: '.$margin_right.'px;width: '.$width.'px;height: '.$height.'px;" src="'.Yii::app()->baseUrl.$attachment1.'"/>';                
                return ;
            }
            
        }
        if($attachment2!=""){
            $extension=  strtolower(FunctionCommon::getExtensionFile($attachment2));
            if(in_array($extension, Constants::$imgExtention)){                
                $url = ltrim($attachment2, '/');
                list($width_orig, $height_orig) = getimagesize($url);                
                if($width_orig>136){
                    $width=136;
                }
                else{
                    $width=$width_orig;
                }
                $height= ceil($height_orig*$width/$width_orig);
                if($height>87){
                    $height=87;
                    $ratio=$width_orig/$height_orig;
                    $width= ceil($height*$ratio);
                }
                if(136>=$width){
                    $margin_right=136-$width;
                }
                else{
                    $margin_right=0;
                }
                echo '<img style="margin-right: '.$margin_right.'px;width: '.$width.'px;height: '.$height.'px;" src="'.Yii::app()->baseUrl.$attachment2.'"/>';                
                return ;
            }
            
        }
        if($attachment3!=""){
            $extension=  strtolower(FunctionCommon::getExtensionFile($attachment3));
            if(in_array($extension, Constants::$imgExtention)){                
                $url = ltrim($attachment3, '/');
                list($width_orig, $height_orig) = getimagesize($url);
                if($width_orig>136){
                    $width=136;
                }
                else{
                    $width=$width_orig;
                }
                $height= ceil($height_orig*$width/$width_orig);
                if($height>87){
                    $height=87;
                    $ratio=$width_orig/$height_orig;
                    $width= ceil($height*$ratio);
                }
                if(136>=$width){
                    $margin_right=136-$width;
                }
                else{
                    $margin_right=0;
                }
                
                echo '<img style="margin-right: '.$margin_right.'px;width: '.$width.'px;height: '.$height.'px;" src="'.Yii::app()->baseUrl.$attachment3.'"/>';                
                return ;
            }
            
        }
        echo '<img src="'.Yii::app()->request->baseUrl.'/css/common/img/img_photo01.gif"/ style="width:136px;height:87px/>';
    }

}
