<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<input type="hidden" id="page_count" value="<?php echo $pages->getPageCount(); ?>"/>
<div class="wrapper secondary">
    
    <div class="content_left"> 


        <?php
        $home_link = '/play';
        $link_array = array();
        $link_array[] = array("text" => "Tin tức bóng đá", "link" => '/playhobby_new');
        $this->widget('Path_actionwidget', array('home_link' => $home_link, 'link_array' => $link_array));
        ?>
        <div class="pageTtl1"><h2></h2>
                    
                    <?php if (FunctionCommon::isPostFunction("hobby_new") == true) {
                        ?>
                        <a href="<?php echo Yii::app()->baseUrl ?>/playhobby_new/regist" class="btn btn-important"><i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?></a>
                    <?php } ?>
                </div>

        <div class="box_left">
            <h2 class="skyblue">
                <span>
                   <?php echo Config::TEXT_FOR_SHOW_HEADER_INDEX;?>
                </span>

            </h2>

            <div class="list_new">

                <?php if (isset($newest_row) && is_array($newest_row) && count($newest_row) > 0) { ?>
                    <div class="left_list">
                        <?php
                        $attachment = $newest_row['attachment1'];
                        if ($attachment != "") {
                            $filename = ltrim($attachment, '/');
                            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
                            if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                                $thumnail_file_path = ltrim($thumnail_file_path, '/');

                                list($width_orig, $height_orig) = getimagesize($thumnail_file_path);
                                if ($width_orig > 323) {
                                    $width = 323;
                                } else {
                                    $width = $width_orig;
                                }
                                $height = ceil($height_orig * $width / $width_orig);
                                if ($height > 182) {
                                    $height = 182;
                                    $ratio = $width_orig / $height_orig;
                                    $width = ceil($height * $ratio);
                                }
                                echo '<img style="margin: 0 auto;width:' . $width . 'px;height:' . $height . 'px;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/>';
                            }
                        }
                        ?>
    <!--                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/img_big.png">-->
                        <h3>
                            <?php //echo htmlspecialchars($newest_row['title']); ?>
                            <?php echo CHtml::link(htmlspecialchars($newest_row['title']), array('playhobby_new/detail', 'id' => $newest_row['id'])); ?>
                        </h3>
                        <span class="time"><?php echo FunctionCommon::formatDate($newest_row['created_date']); ?></span>
                        <p style="word-wrap: break-word;"><?php echo nl2br($newest_row['content']); ?>. </p>
                    </div>
                    <?php
                }
                ?>
                <div class="right_list">
                    <ul>                        
                        <?php
                        if (!is_null($model)) {
                            foreach ($model as $item) {
                                ?>
                                <li>

                                    <div class="img_tieudiem">
                                        <?php
                                        $attachment = $item->attachment1;
                                        if ($attachment != "") {
                                            $filename = ltrim($attachment, '/');
                                            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
                                            if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                                                $thumnail_file_path = ltrim($thumnail_file_path, '/');

                                                list($width_orig, $height_orig) = getimagesize($thumnail_file_path);
                                                if ($width_orig > 74) {
                                                    $width = 74;
                                                } else {
                                                    $width = $width_orig;
                                                }
                                                $height = ceil($height_orig * $width / $width_orig);
                                                if ($height > 74) {
                                                    $height = 74;
                                                    $ratio = $width_orig / $height_orig;
                                                    $width = ceil($height * $ratio);
                                                }
                                                echo '<img style="width:' . $width . 'px;height:' . $height . 'px;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/>';
                                            }
                                        }
                                        ?>
        <!--                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/img_small.png">-->
                                    </div>
                                    <div class="txt_tieudiem" style="width: 220px;">
                                        <?php echo CHtml::link(htmlspecialchars($item->title), array('playhobby_new/detail', 'id' => $item->id)); ?>
                                        <span class="time"><?php echo FunctionCommon::formatDate($item->created_date); ?></span>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="line_new"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/line_news.png"></div>
            <div class="list_new_bottom">
                <ul>

                    <?php
                    if (!is_null($model)) {
                        foreach ($model as $item) {
                            ?>
                            <li>
                                <div class="img_bottom">
                                    <?php
                                    $attachment = $item->attachment1;
                                    if ($attachment != "") {
                                        $filename = ltrim($attachment, '/');
                                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
                                        if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                                            $thumnail_file_path = ltrim($thumnail_file_path, '/');
                                            list($width_orig, $height_orig) = getimagesize($thumnail_file_path);
                                            if ($width_orig > 100) {
                                                $width = 100;
                                            } else {
                                                $width = $width_orig;
                                            }
                                            $height = ceil($height_orig * $width / $width_orig);
                                            if ($height > 100) {
                                                $height = 100;
                                                $ratio = $width_orig / $height_orig;
                                                $width = ceil($height * $ratio);
                                            }
                                            echo '<img style="width:' . $width . 'px;height:' . $height . 'px;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/>';
                                        }
                                    }
                                    ?>
        <!--                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/img_bottom.png">-->
                                </div>
                                <div class="txt_botom" style="width: 550px;">
                                    <?php echo CHtml::link(htmlspecialchars($item->title), array('playhobby_new/detail', 'id' => $item->id)); ?>
                                    <span class="time"><?php echo FunctionCommon::formatDate($item->created_date); ?></span>
                                    <p style="word-wrap: break-word;">
                                        <?php
                                        $content = nl2br($item->content);
                                        if (strlen($content) <= 198) {
                                            echo $content . '.';
                                        } else {
                                            echo FunctionCommon::crop(nl2br($content), 198, $enable_br_tag = true);
                                        }
                                        ?> </p>
                                    <a class="more">Xem thêm</a>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <?php
            $this->widget('CLinkPager', array(
                'currentPage' => $pages->getCurrentPage(),
                'itemCount' => $item_count,
                'pageSize' => $page_size,
                'maxButtonCount' => 5,
                'nextPageLabel' => 'Next',
                'prevPageLabel' => 'Previous',
                'lastPageLabel' => 'Last',
                'firstPageLabel' => 'First',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination'),
            ));
            ?>

            <div class="pagination" id="pagination"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
