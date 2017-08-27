<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
</style>

<input type="hidden" id="page_count" value="<?php echo $pages->getPageCount(); ?>"/>
<div class="wrapper secondary admin">
    
    <div class="content_left">
        	
       	  <?php
        $home_link = '/play';
        $link_array = array();
        $link_array[] = array("text" => "Coffee break", "link" => '/playcoffee');
        $this->widget('Path_actionwidget', array('home_link' => $home_link, 'link_array' => $link_array));
        ?>
            <div class="pageTtl1"><h2></h2>
                    
                    <?php if (FunctionCommon::isPostFunction("coffee") == true) {
                        ?>
                        <a href="<?php echo Yii::app()->baseUrl ?>/playcoffee/regist" class="btn btn-important"><i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?></a>
                    <?php } ?>
                </div>
            <div class="box_left">
            	<h2 class="skyblue">
                	<span>
                    <?php echo Config::TEXT_FOR_SHOW_HEADER_INDEX;?>
                    </span>
                </h2>
                
                <div class="list_no_images">
                	<ul>
                            <?php 
                            if (!is_null($model)) {
                            foreach ($model as $item) {
                            ?>
                            <li>
                            
                        <div class="txt_no_images">
                            <?php echo CHtml::link(htmlspecialchars($item->title), array('playcoffee/detail', 'id' => $item->id)); ?>
                            <span class="time"><?php echo FunctionCommon::formatDate($item->created_date); ?></span>
                            <p style="word-wrap: break-word;"><?php
                                        $content = nl2br($item->content);
                                        if (strlen($content) <= 198) {
                                            echo $content . '.';
                                        } else {
                                            echo FunctionCommon::crop(nl2br($content), 198, $enable_br_tag = true);
                                        }
                                        ?></p>                            
                            <a class="more" href="<?php echo Yii::app()->request->baseUrl.'/playcoffee/detail?id='.$item->id;?>">Xem thêm</a>
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
