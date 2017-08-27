<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/tab_cv.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/toppage.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/als_demo.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/zebra_dialog.css" rel="stylesheet" type="text/css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/zebra_dialog.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-paged-scroll.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/js/jquery.alsEN-1.0.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>


<div class="wrapper">
    <div class="sidebar">
        <div class="box_bar">
            <?php $this->widget('Newswidget'); ?>
            <?php
                if (FunctionCommon::isPostFunction("news") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/playnews/regist" class="bt_dangtai"></a>';
                }
                ?>

<?php
            if(FunctionCommon::isViewFunction("news")==true){
                echo '<a href="'.Yii::app()->baseUrl . '/playnews/" class="more">Xem thêm</a>';
            }
            ?>
            
            
            <div class="clear"></div>
        </div>
        <div class="box_bar">
            <div id="mood_dialog" style="display: none;position: absolute;z-index: 2000;padding-bottom: 200px;">    
                <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/loading.gif" style="width: 150px;height: 150px;"/>    
            </div>
            <h2 class="violet">
                <span style="font-size:14px"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_happy.png"> Hôm nay bạn thấy thế nào</span>
            </h2>
            <div class="list_quiz">
                <form action="" method="POST" id="mood_form">
                    <p><b>Hôm nay bạn cảm thấy thế nào ?</b></p>
                    <?php
                    $mood_detail_id = Yii::app()->db->createCommand()
                            ->select("mood_id")
                            ->from("mood_detail")
                            ->where("user_id=" . Yii::app()->request->cookies['id']->value . " and date(create_date)='" . date("Y-m-d") . "'")
                            ->queryScalar();
                    if ($mood_detail_id == FALSE) {
                        $mood_detail_id = '';
                    }
                    $rows = Yii::app()->db->createCommand()
                            ->select("*")
                            ->from("mood")
                            ->queryAll();
                    $is_exist_mood = FALSE;
                    if (is_array($rows) && count($rows) > 0) {
                        foreach ($rows as $row) {
                            if ($mood_detail_id == $row['id']) {
                                $is_exist_mood = TRUE;
                            }
                        }
                        if ($is_exist_mood == TRUE) {
                            foreach ($rows as $row) {
                                if ($mood_detail_id == $row['id']) {
                                    echo '<p><label><input checked type="radio"> ' . $row['name'] . '</label></p>';
                                } else {
                                    echo '<p><label><input disabled="disabled" type="radio"> ' . $row['name'] . '</label></p>';
                                }
                            }
                        } else {
                            foreach ($rows as $row) {
                                echo '<p><label><input type="radio" name="mood_id" value="' . $row['id'] . '"> ' . $row['name'] . '</label></p>';
                            }
                        }
                    }
                    if ($is_exist_mood == FALSE) {
                        ?>                     
                        <a id="mood_comment" style="cursor: pointer;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/btn_danhgia.png"></a>
                        <?php
                    }
                    ?>
                    <input type="hidden" name="user_id" value="<?php echo Yii::app()->request->cookies['id']->value; ?>"/>
                </form>


            </div>
        </div>
        <div class="box_bar">
            <h2 class="azure">
                <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_coffe.png">Coffe Break!</span>
                <?php
                if (FunctionCommon::isPostFunction("coffee") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/playcoffee/regist" class="bt_dangtai11"></a>';
                }
                ?>
                
            </h2>
            <div class="list_coffe">
                <?php $this->widget('Coffeewidget'); ?>
                
                
            </div>
            <?php
            if(FunctionCommon::isViewFunction("coffee")==true){
                echo '<a href="'.Yii::app()->baseUrl . '/playcoffee/" class="more">Xem thêm</a>';
            }
            ?>
            
            <div class="clear"></div>
        </div>
        
<?php 
if (FunctionCommon::isViewFunction("fortune") == true) {
//$this->widget('FortuneWidget');    
}
 ?>


<!--        <div class="box_bar">
            <h2 class="green">
                <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_chamngon.png"> CHÂM NGÔN</span>
            </h2>
<?php //$this->widget('MeigenWidget'); ?>
        </div>-->
        <div class="box_bar">
            <div id="comment_dialog" style="display: none;position: absolute;z-index: 2000;padding-bottom: 200px;">    
                <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/loading.gif" style="width: 150px;height: 150px;"/>    
            </div>
            <h2 class="skyblue">
                <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_thamdo.png"> Hãy gửi cho tôi</span>
            </h2>
            <div class="list_quiz">
                <form action="" method="POST" id="comment_form">
                    <p><b>Theo bạn giao diện thiết kế như vậy hợp lý và đẹp chưa ?</b></p>
<?php
$design_comment_id = Yii::app()->db->createCommand()
        ->select("design_comment_id")
        ->from("design_comment_detail")
        ->where("user_id=" . Yii::app()->request->cookies['id']->value)
        ->queryScalar();
if ($design_comment_id == FALSE) {
    $design_comment_id = '';
}
$rows = Yii::app()->db->createCommand()
        ->select("*")
        ->from("design_comment")
        ->queryAll();
if (is_array($rows) && count($rows) > 0) {
    foreach ($rows as $row) {
        $check = "";
        if ($design_comment_id == $row['id']) {
            $check = " checked";
        }
        echo '<p><label><input' . $check . ' type="radio" name="design_comment_id" value="' . $row['id'] . '">' . $row['name'] . '</label></p>';
    }
}
?>                
                    <a id="design_comment" style="cursor: pointer;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/btn_bieuquyet.png"></a>
                    <a id="design_comment_view" style="padding-left:10px">XEM KẾT QUẢ</a>
                    <input type="hidden" name="user_id" value="<?php echo Yii::app()->request->cookies['id']->value; ?>"/>
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="content_left">
        <div class="box_slide">
            <h2>
                <span>HAPPY BOX</span>
                <?php
                if (FunctionCommon::isPostFunction("thanks") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/adminthanks/regist" class="bt_dangtai"></a>';
                }
                ?>
            </h2>
            <div class="box_content_slide">
                <div id="lista1" class="als-container">
                    <span class="als-prev" data-id="als-prev_0"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/thin_left_arrow_333.png" alt="prev" title="previous"></span>
                    <div class="als-viewport" id="als-viewport_0" style="width: 660px; height: 140px;">
<?php $this->widget('Thankswidget'); ?>
                    </div>
                    <span class="als-next" data-id="als-next_0"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/thin_right_arrow_333.png" alt="next" title="next"></span>
                </div>
            </div>
        </div>
        <div class="box_left">
            <div class="think_about" style="height: auto;">
                <div style="float:left;">
                    <form id="room-chat" method="POST">
                        <textarea name="content" id="ckeditor_input" placeholder="Nói gì đi chứ!!!!"></textarea>                                        
                        <input type="hidden" name="user_id" value="<?php echo Yii::app()->request->cookies['id']->value; ?>"/>
                    </form>

                </div>

<!--                <input class="input_think" placeholder="Nói gì đi chứ!!!!">-->
                <div style="float:left;" id="send-message-for-room">
                    <a style="cursor: pointer;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/btn_gui.png"></a>
                </div>
                <div style="clear: both;"></div>

            </div>
            <div id="room-chat-content" style="overflow-y: scroll;max-height: 300px;border-width: 1px;border-style: solid;margin-top: 10px;">
<?php
Yii::app()->db->createCommand("delete from room_chat where user_id=" . Yii::app()->request->cookies['id']->value . " and is_saved=0")->execute();
$chat_rooms = Yii::app()->db->createCommand()
        ->select("*")
        ->from("view_room_chat")
        ->where("is_saved=1")
        ->order("send_time desc")
        ->limit(10)
        ->queryAll();
if (is_array($chat_rooms) && count($chat_rooms) > 0) {
    foreach ($chat_rooms as $chat_room) {
        ?>
                        <div class="room_message" style="vertical-align: middle;padding-left: 20px;margin-top: 50px;">
                            <div style="float: left;margin-right: 5px;">[<?php echo convert_time($chat_room['send_time']); ?>]</div>
                            <div style="float: left;margin-right: 5px;"><?php echo $chat_room['lastname'] . ' ' . $chat_room['firstname'] . ':'; ?></div>
                            <div style="float: left;margin-right: 5px;"><?php echo base64_decode($chat_room['content']); ?></div>
                            <div class="clear"></div>
                        </div>   
        <?php
    }
}
?>

            </div>


<!--            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/chatbox.png">-->
        </div>
        <div class="box_left">
            <h2 class="plum">
                <span>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_smile.png">
                    Vừa làm vừa vui .. :D
                </span>
                <?php
                if (FunctionCommon::isPostFunction("work_smile") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/playwork_smile/regist" class="bt_dangtai"></a>';
                }
                ?>
                <a class="more_tit" href="<?php echo Yii::app()->request->baseUrl . '/playwork_smile'; ?>">Xem thêm</a>
            </h2>
            <div class="list_smile">
<?php $this->widget('Work_smilewidget'); ?>
            </div>
        </div>
        <div class="box_left">
            <h2 class="purple">
                <span>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/images/icon_football.png">
                    Hãy đá bay stress đi
                </span>

            </h2>            
            <div class="new_football">
                <h3>
                    TIN TỨC MỚI
                    <?php
                if (FunctionCommon::isPostFunction("hobby_new") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/playhobby_new/regist" class="bt_dangtai"></a>';
                }
                ?>
                    
<?php
if (FunctionCommon::isViewFunction("hobby_new")) {
    ?>                
                        <a style="float:right;margin-right: 20px;" href="<?php echo Yii::app()->baseUrl; ?>/playhobby_new">Xem thêm</a>
                        <?php
                    }
                    ?>

                </h3>
                    <?php $this->widget('Hobby_newWidget'); ?>
                <h2>
                
                    </h2>
                <h3>
                    ẢNH THÀNH VIÊN
                    <?php
                if (FunctionCommon::isPostFunction("hobby_itd") == true) {
                    echo '<a href="'.Yii::app()->baseUrl.'/adminhobby_itd/regist" class="bt_dangtai"></a>';
                }
                
                if (FunctionCommon::isViewFunction("hobby_itd")) {
                    ?>                
                        <a style="float:right;margin-right: 20px;" href="<?php echo Yii::app()->baseUrl; ?>/playhobby_itd">Xem thêm</a>
                        <?php
                    }
                    ?>
                </h3>
                    <?php $this->widget('Hobby_itdwidget'); ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script language="javascript">
    var myVar1 = setInterval("add2Button()", 1000);
    var myVar2 = setInterval("remove_cke_14()", 2000);
    function remove_cke_14() {
        if (jQuery("a#cke_14") != undefined) {
            jQuery("a#cke_14").remove();
            clearInterval(myVar2);
        }
    }
    function add2Button() {
        if (jQuery("td#cke_top_ckeditor_input") != undefined) {
            jQuery("td#cke_top_ckeditor_input").append('<div id="refresh-message" style="padding-top: 4px;vertical-align: middle;margin-top: 3px;margin-right: 10px;height: 20px;width: 80px;cursor: pointer;text-align: center;border-style: solid;border-width: 1px;float: right;">Refresh</div>');
            jQuery("td#cke_top_ckeditor_input").append('<div id="save-message" style="padding-top: 4px;vertical-align: middle;margin-top: 3px;margin-right: 10px;height: 20px;width: 80px;cursor: pointer;text-align: center;border-style: solid;border-width: 1px;float: right;">Lưu trữ</div>');
            
            
            clearInterval(myVar1);
        }
    }
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
        return true;
    }
    jQuery(function($) {  
        
        $("li.als-item").click(function (){
           thankId=$(this).find("div.img_slide").eq(0).attr("id"); 
           var textInit = '<div style="width: 600px;height: 400px;">    ' +
                    '<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/loading.gif" style="width: 150px;height: 150px;margin-top: 125px;margin-left: 225px;"/>  ' +
                    '</div>';
            $.Zebra_Dialog(textInit, {
                'buttons': ['Close'],
                'title': '',
                width: 800,
                height: 500,
                'position': ['left + 250', 'top + 40']
            });

            $.ajax({
                type: "GET",
                async: true,                
                url: "<?php echo Yii::app()->baseUrl; ?>/adminthanks/detail/?id="+thankId,
                success: function(msg) {

                    
                    $(".ZebraDialog_Body").html(msg);

                }
            });
           
        });


        $("#lista1").als({
            visible_items: 3,
            scrolling_items: 1,
            orientation: "horizontal",
            circular: "yes",
            autoscroll: "yes",
            interval: 5000,
            direction: "right"
        });
        var settingsDiv = {
            handleScroll: function(page, container, doneCallback) {
                setTimeout(function() {                    
                    $.ajax({
                        async: true,
                        url: "roomchat.php?page=" + page,
                        success: function(msg) {
                            $('#room-chat-content').append(msg);
                            if($.trim(msg)!='<div class="room_message" style="vertical-align: middle;line-height: 100px;text-align: center;color: red;"><h2>End</h2></div>'){
                                doneCallback();
                            }
                            else{                       
                                $("div.paged-scroll-loading").hide();
                            }
                            
                        }
                    });
                }, 1000);

            },
            //        pagesToScroll : 5,
            triggerFromBottom: '10%',
            //loader: '<div class="loader"></div>',
            debug: true,
            targetElement: $('#room-chat-content'),
            startPage: 1,
            monitorTargetChange: false


        };
        $('#room-chat-content').paged_scroll(settingsDiv);


        CKEDITOR.replace('ckeditor_input',
                {
                    height: 60, width: 601, skin: 'office2003', removePlugins: 'elementspath', resize_enabled: false, language: 'en', toolbar: [['Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Smiley', 'TextColor']]
                });

        $("body").delegate("div#refresh-message", "click", function() {
            $('#room-chat-content').html("");
//            $room=$('#room-chat-content');
//            var instance = new $.ajax_scroll($room, settingsDiv);
//            $.data($room, 'jqueryPagedScroll', instance);
            $.ajax({
                async: true,
                url: "roomchat.php",
                success: function(msg) {
                    $('#room-chat-content').append(msg);
                }
            });
        });
        $("body").delegate("div#save-message", "click", function() {
            $.ajax({
                type: "POST",
                async: true,
                data: jQuery('#room-chat').serialize(),
                url: "<?php echo Yii::app()->baseUrl; ?>/play/savemessageajax",
                success: function(data) {
                    alert("Successful");
                }

            });
        });
        $("a#design_comment_view").click(function() {
            var textInit = '<div style="width: 600px;height: 400px;">    ' +
                    '<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/loading.gif" style="width: 150px;height: 150px;margin-top: 125px;margin-left: 225px;"/>  ' +
                    '</div>';
            $.Zebra_Dialog(textInit, {
                'buttons': ['Close'],
                'title': 'Thông tin nhận xét về thiết kế giao diện.',
                width: 800,
                height: 500,
                'position': ['left + 250', 'top + 40']
            });

            $.ajax({
                type: "POST",
                async: true,
                data: jQuery('#twiiter_form').serialize(),
                url: "<?php echo Yii::app()->baseUrl; ?>/play/designcommentajax",
                success: function(msg) {

                    msg = unescape(msg);
                    $(".ZebraDialog_Body").html(msg);

                }
            });

        });
        $("a#design_comment").click(function() {


            $('div#comment_dialog').show();


            $.ajax({
                type: "POST",
                async: true,
                data: jQuery('#comment_form').serialize(),
                url: "<?php echo Yii::app()->baseUrl; ?>/playdesign/commentajax",
                success: function(msg) {
                    $('div#comment_dialog').hide();

                }
            });

        });
        $("a#mood_comment").click(function() {


            $('div#mood_dialog').show();


            $.ajax({
                type: "POST",
                async: true,
                data: jQuery('#mood_form').serialize(),
                url: "<?php echo Yii::app()->baseUrl; ?>/playmood/commentajax",
                success: function(msg) {
                    $('div#mood_dialog').hide();
                    $("a#mood_comment").remove();
                    radios = $("input[name='mood_id']");
                    for (i = 0, n = radios.length; i < n; i++) {
                        if (!$(radios[i]).is(":checked")) {
                            $(radios[i]).attr("disabled", "disabled");
                        }
                    }

                }
            });

        });



        $("div#send-message-for-room").click(function() {





            CKupdate();


            $.ajax({
                type: "POST",
                async: true,
                data: jQuery('#room-chat').serialize(),
                url: "<?php echo Yii::app()->baseUrl; ?>/play/sendmessageajax",
                success: function(data) {
                    $("#room-chat-content").prepend(data);
                }

            });

        });
    });

   



</script>


<?php

function convert_time($date_time) {
    $temp = explode(" ", $date_time);
    $date = convertToDate($temp[0]);
    $today = convertToDate(date("Y-m-d"));
    $result = '';
    if ($date == $today) {
        $result.='Today';
    } else {
        $result.=$date->format("d/m/Y");
    }
    $result.=' ';
    $result.=date('h:i A', strtotime($date_time));
    return $result;
}

function convertToDate($string) {
    $date = new DateTime("$string");
    return $date;
}
?>