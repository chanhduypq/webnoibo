<?php

class Work_smilewidget extends CWidget {

    

    public function init() {
        
    }

    public function run() {
        // SQL Query	
        $sql = "select * from work_smile order by created_date desc limit 3";
        // Define the DB connection for this page(to use your database first you have to remove the comment in code phrase in Config.php)
        $connection = Yii::app()->db;
        // Execute the sql
        $command = $connection->createCommand($sql);
        $work_smiles = $command->queryAll();


        

        if (FunctionCommon::isViewFunction("work_smile")) {
            if (count($work_smiles) > 0) {
                $work_smile_left = $work_smiles[0];
            } else {
                $work_smile_left = array();
            }
            if (count($work_smiles) > 1) {
                $work_smile_right_above = $work_smiles[1];
            } else {
                $work_smile_right_above = array();
            }
            if (count($work_smiles) > 2) {
                $work_smile_right_below = $work_smiles[2];
            } else {
                $work_smile_right_below = array();
            }
            ?>
            <div class="left_smile">
            <?php
            if (is_array($work_smile_left) && count($work_smile_left) > 0) {
                ?>
                    <a href="<?php echo Yii::app()->request->baseUrl . '/playwork_smile/detail?id=' . $work_smile_left['id']; ?>">
                <?php
                if ($work_smile_left['attachment1'] != "" && file_exists(Yii::getPathOfAlias('webroot') . FunctionCommon::getFilenameInThumnail($work_smile_left['attachment1']))) {

                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($work_smile_left['attachment1']);
                    $url = ltrim($thumnail_file_path, '/');
                    list($width_orig, $height_orig) = getimagesize($url);
                    if ($width_orig > 450) {
                        $width = 450;
                    } else {
                        $width = $width_orig;
                    }
                    $height = ceil($height_orig * $width / $width_orig);
                    if ($height > 416) {
                        $height = 416;
                        $ratio = $width_orig / $height_orig;
                        $width = ceil($height * $ratio);
                    }
//                    if ($height_orig > 416) {
//                        $height = 416;                            
//                    }
//                    else{
//                        $height=$height_orig;
//                    }                        
//                    $width = ceil($width_orig  * $height / $height_orig);                        
//                    if ($width > 450) {
//                        $width = 450;
//                        $ratio = $height_orig  / $width_orig;
//                        $height = ceil($width * $ratio);
//                    }
                    ?>
                            <img style="width: <?php echo $width; ?>px;height: <?php echo $height; ?>px;" src="<?php echo FunctionCommon::getFilenameInThumnail($work_smile_left['attachment1']); ?>"/>
                        <?php
                        } else {
                            ?> 
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/smile1.png">
                            <?php
                        }
                        ?>
                        <div class="bg_smile">
                            <h4><?php echo FunctionCommon::crop(htmlspecialchars($work_smile_left['title']), 20); ?></h4>
                            <p style="word-wrap: break-word;"><?php
                        $content = nl2br($work_smile_left['content']);
                        if (strlen($content) <= 198) {
                            echo $content . '.';
                        } else {
                            echo FunctionCommon::crop(nl2br($content), 198, $enable_br_tag = true);
                        }
                        ?></p>
                        </div>
                    </a>
                                <?php
                            }
                            ?>
            </div>
            <div class="right_smile">
                <?php
                if (is_array($work_smile_right_above) && count($work_smile_right_above) > 0) {
                    ?>
                    <div class="box1_smile">
                        <a href="<?php echo Yii::app()->request->baseUrl . '/playwork_smile/detail?id=' . $work_smile_right_above['id']; ?>">
                    <?php
                    if ($work_smile_right_above['attachment1'] != "" && file_exists(Yii::getPathOfAlias('webroot') . FunctionCommon::getFilenameInThumnail($work_smile_right_above['attachment1']))) {

                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($work_smile_right_above['attachment1']);
                        $url = ltrim($thumnail_file_path, '/');
                        list($width_orig, $height_orig) = getimagesize($url);
                        if ($width_orig > 217) {
                            $width = 217;
                        } else {
                            $width = $width_orig;
                        }
                        $height = ceil($height_orig * $width / $width_orig);
                        if ($height > 201) {
                            $height = 201;
                            $ratio = $width_orig / $height_orig;
                            $width = ceil($height * $ratio);
                        }
 
                        ?>
                                <img style="width: <?php echo $width; ?>px;height: <?php echo $height; ?>px;" src="<?php echo FunctionCommon::getFilenameInThumnail($work_smile_right_above['attachment1']); ?>"/>
                            <?php
                            } else {
                                ?> 
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/smile2.png">
                                <?php
                            }
                            ?>
                            <span><?php echo FunctionCommon::crop(htmlspecialchars($work_smile_right_above['title']), 20); ?></span>
                        </a>
                    </div>
                            <?php
                        }
                        ?>
            <?php
            if (is_array($work_smile_right_below) && count($work_smile_right_below) > 0) {
                ?>
                    <div class="box1_smile">
                        <a href="<?php echo Yii::app()->request->baseUrl . '/playwork_smile/detail?id=' . $work_smile_right_below['id']; ?>">
                    <?php
                    if ($work_smile_right_below['attachment1'] != "" && file_exists(Yii::getPathOfAlias('webroot') . FunctionCommon::getFilenameInThumnail($work_smile_right_below['attachment1']))) {

                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($work_smile_right_below['attachment1']);
                        $url = ltrim($thumnail_file_path, '/');
                        list($width_orig, $height_orig) = getimagesize($url);
                        if ($width_orig > 217) {
                            $width = 217;
                        } else {
                            $width = $width_orig;
                        }
                        $height = ceil($height_orig * $width / $width_orig);
                        if ($height > 201) {
                            $height = 201;
                            $ratio = $width_orig / $height_orig;
                            $width = ceil($height * $ratio);
                        }
                        ?>
                                <img style="width: <?php echo $width; ?>px;height: <?php echo $height; ?>px;" src="<?php echo FunctionCommon::getFilenameInThumnail($work_smile_right_below['attachment1']); ?>"/>
                            <?php
                            } else {
                                ?> 
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/smile2.png">
                                <?php
                            }
                            ?>
                            <span><?php echo FunctionCommon::crop(htmlspecialchars($work_smile_right_below['title']), 20); ?></span>
                        </a>
                    </div>
                            <?php
                        }
                        ?>

            </div>
            <div class="clear"></div>
                <?php
            }
        }

    }
    