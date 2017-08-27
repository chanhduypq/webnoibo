<?php
$yii = dirname(__FILE__) . '/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
require_once($yii);
Yii::createWebApplication($config);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//if(isset($_GET['refresh'])&&$_GET['refresh']=='1'){
//    $limit=20;
//}
//else{
//    $limit=10;
//}
$limit=10;
$chat_rooms = Yii::app()->db->createCommand()
        ->select(
                array(
                    'send_time',
                    'lastname',
                    'firstname',
                    'content'
                    )
                )
        ->from("view_room_chat")
        ->where("is_saved=1")
        ->order("send_time desc")
        ->limit($limit, ($page - 1) * $limit)
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
else{
    echo '<div class="room_message" style="vertical-align: middle;line-height: 100px;text-align: center;color: red;"><h2>End</h2></div>';
}

function convert_time($date_time){
    $temp=  explode(" ", $date_time);
    $date=  convertToDate($temp[0]);    
    $today=  convertToDate(date("Y-m-d"));    
    $result='';
    if($date==$today){
        $result.='Today';
    }    
    else{
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



