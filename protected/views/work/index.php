<link href="<?php echo Yii::app()->request->baseUrl;?>/css/play/css/zebra_dialog.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/tab_cv.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/css/prettyPhoto.css" rel="stylesheet"  media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/js/initPrettyPhoto.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/zebra_dialog.js"></script>

	<div class="wrapper">
    	<div class="tab_work">
            <div class="news">
                    <?php $this->widget('News_cvwidget'); ?>
           <?php $this->widget('Noticewidget'); ?>



            </div>
            
            <div class="all_box">
            	<div class="col_left">
                	<div class="box">
                            <?php 
                        $this->widget('Contributewidget');
                        ?>

                    </div>
                    <div class="box">
                        <?php 
                        $this->widget('Ideaswidget');
                        ?>

                    </div>
                    <div class="box">
                        <?php 
                        $this->widget('Investigatewidget');
                        ?>
                    </div>
                    <div class="box from_hr">
                        <?php 
                        $this->widget('Hrwidget');
                        ?>
                    </div>
                </div>
                <div class="col_right">
                	<div class="box">
                            <?php $this->widget('Criticismwidget'); ?>
                    </div>
                    <div class="box">
                        <?php $this->widget('Planwidget'); ?>
                    </div>
                    <div class="box">
                        <?php 
                        $this->widget('Itcontestwidget');
                        ?>

                    </div>
                    <div class="sendemail">
                    	<h2><span></span>Đóng góp ý kiến</h2>
                        <div>
                        	<p>(Mọi thắc mắc và đóng góp ý kiến về tất cả nội dung trên website)</p>
                            <input name="" type="text" placeholder="Email">
                            <textarea name="" cols="" rows="10" placeholder="Nội dung"></textarea>
                            <a href="" class="bt_send"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>




<script language="javascript">
    jQuery(function($) 
	{ 
	$("div#div_pickup").click(function (){                        
            html=$("div#div_pickup_content").html();
            msg='<div class="popup_user" style="height:500px;">'+html+'</div>';
            $.Zebra_Dialog(msg, {                                
                                         'buttons':[' とじる'],
                                         width: 1000
                                       
                                     });  
           
            
            
           
        });

	});

</script>