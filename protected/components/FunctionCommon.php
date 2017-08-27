<?php

/**
 * FunctionCommon
 * Use contain function common
 * @author Hainh
 * @Company GMO Runsystem
 * @since 1.1 - 20130703
 */
class FunctionCommon {
    public static function get_icon_for_criticism($attachment1,$attachment2,$attachment3){        
        if($attachment1!=""){
            $extension=  strtolower(self::getExtensionFile($attachment1));
            if(in_array($extension, Constants::$imgExtention)){
                return "ico_image";
            }
            else if(in_array($extension, Constants::$excelExtention)){
                return "ico_excel";
            }
            else if(in_array($extension, Constants::$pdfExtention)){
                return "ico_pdf";
            }
            else if(in_array($extension, Constants::$powerpointExtention)){
                return "ico_ppt";
            }
            else if(in_array($extension, Constants::$wordExtention)){
                return "ico_word";
            }
            else if(in_array($extension, Constants::$zipExtention)){
                return "ico_zip";
            }
        }
        if($attachment2!=""){
            $extension=  strtolower(self::getExtensionFile($attachment2));
            if(in_array($extension, Constants::$imgExtention)){
                return "ico_image";
            }
            else if(in_array($extension, Constants::$excelExtention)){
                return "ico_excel";
            }
            else if(in_array($extension, Constants::$pdfExtention)){
                return "ico_pdf";
            }
            else if(in_array($extension, Constants::$powerpointExtention)){
                return "ico_ppt";
            }
            else if(in_array($extension, Constants::$wordExtention)){
                return "ico_word";
            }
            else if(in_array($extension, Constants::$zipExtention)){
                return "ico_zip";
            }
        }
        if($attachment3!=""){
            $extension=  strtolower(self::getExtensionFile($attachment3));
            if(in_array($extension, Constants::$imgExtention)){
                return "ico_image";
            }
            else if(in_array($extension, Constants::$excelExtention)){
                return "ico_excel";
            }
            else if(in_array($extension, Constants::$pdfExtention)){
                return "ico_pdf";
            }
            else if(in_array($extension, Constants::$powerpointExtention)){
                return "ico_ppt";
            }
            else if(in_array($extension, Constants::$wordExtention)){
                return "ico_word";
            }
            else if(in_array($extension, Constants::$zipExtention)){
                return "ico_zip";
            }
        }
        return '';
    }

    public static function url_henkan($mojiretu) {
        $mojiretu = htmlspecialchars($mojiretu, ENT_QUOTES);
        //$mojiretu = nl2br($mojiretu);
//文字列にURLが混じっている場合のみ下のスクリプト発動
        if (preg_match("/(http|https):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?/", $mojiretu)) {
            preg_match_all("/(http|https):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?/", $mojiretu, $pattarn);
            foreach ($pattarn[0] as $key => $val) {
                $replace[] = '<a href="' . $val . '" target="_blank">' . $val . '</a>';
            }
            $mojiretu = str_replace($pattarn[0], $replace, $mojiretu);
        }
        return $mojiretu;
    }

    

    /**
     * @author tuetc
     * @return string
     * @param string $file_name
     */
    public static function getFilenameInThumnail($file_name) {
        if ($file_name == NULL || !is_string($file_name) || trim($file_name) == "") {
            return $file_name;
        }
        $temp = explode("/", $file_name);
        $return_file_name = '';
        for ($i = 1, $n = count($temp) - 1; $i < $n; $i++) {
            $return_file_name.='/' . $temp[$i];
        }
        $return_file_name.='/thumnail';
        $return_file_name.='/' . $temp[count($temp) - 1];
        return $return_file_name;
    }

    

    

    
    public static function formatDate($str, $format = "d/m/Y") {
        if (empty($str) || trim($str) == "0000-00-00 00:00:00") {
            return " ";
        }
        $temp=  explode(" ", $str);
        $temp=$temp[0];
        $temp=  explode("-", $temp);
        return $temp[2].'/'.$temp[1].'/'.$temp[0];
//        $date = new DateTime($str);
//        $return = $date->format($format);
//
//        return $return;
    }
    public static function formatDateFortune($str, $format = "Y/d/m") {
        if (empty($str) || trim($str) == "0000-00-00 00:00:00") {
            return " ";
        }
        $temp=  explode(" ", $str);
        $temp=$temp[0];
        $temp=  explode("-", $temp);
        return $temp[0].'/'.$temp[1].'/'.$temp[2];
        
        
    }

    /**
     * Format time from string
     * @param String $str
     * @return String hour,minute
     * @author Hainhl
     */
    public static function formatTime($datetime) {
        if (empty($datetime) || $datetime == "0000-00-00 00:00:00") {
            return "";
        }

        $hour = date('G', strtotime($datetime));
        $minute = date('i', strtotime($datetime));
        $second = date('s', strtotime($datetime));
        return $hour . ":" . $minute;
    }

    

    /**
     * This is method use get date time in system 
     * @return date time
     * @author Hainhl
     */
    public static function getDateTimeSys() {
        return date('Y-m-d H:i:s');
    }

    /**
     * This is check deadline in system
     * @return boollean
     * @author Hainhl
     */
    public static function checkDeadline($deadline) {
        $isdeadline = true;
        $today = date("Y/m/d");
        $today = strtotime($today);
        if (!is_null($deadline) && !empty($deadline)) {
            $deadline = strtotime(date('Y/m/d', strtotime($deadline)));
            if ($today > $deadline) {
                $isdeadline = false;
            }
        }
        return $isdeadline;
    }

    

    public static function getInforUser($id) {
        $connection = Yii::app()->db;
        $command = $connection->createCommand();
        $command->select(array(
            'lastname',
            'firstname',
            'unit_name',
            'post_name',
        ))
                ->from('user')
                ->join("unit", "unit.id=user.division")
                ->join("post", "post.id=user.position")
                ->where("user.id=$id");
        $user = $command->queryRow();        
        
        if (is_array($user)&&count($user)>0) {
            return "<span class='city'>"  . "&nbsp;" . htmlspecialchars($user['unit_name']).' - '.htmlspecialchars($user['post_name']) . "&nbsp;:&nbsp;&nbsp;</span><span class='name'>" . $user['lastname'] . "&nbsp;" . $user['firstname'] . "</span>";
        }
        
        
        return '';
    }   

    

    /**
     * @this is method use get extension file 
     * @param model
     * @return 
     * @author Hainhl
     */
    public static function getExtensionFile($attachment_file_name) {        
        if (!empty($attachment_file_name)) {
            $attachmentExt = "";
            if ($attachment_file_name != NULL && !empty($attachment_file_name)) {
                $temp = explode(".", $attachment_file_name);
                $attachmentExt = $temp[count($temp) - 1];
                $attachmentExt = strtolower($attachmentExt);
            }
            return $attachmentExt;
        } else {
            return '';
        }
    }

    

    /**
     * @this is echo img_photo01.jpg
     * @param model
     * @return 
     * @author Baodt
     */
    public static function echoEmpty($assetsBase) {

        echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_photo01.jpg">';
    }

    

    /**
     * @this is get file Old
     * @param model
     * @return 
     * @author Baodt
     * date: 11/07/2013
     */
    public static function echoOldFile($host_file_attachment_ext, $order_index, $model, $url, $assetsBase, $edit = false) {
        $cookie_name = 'file_' . strtolower(get_class($model)) . '_edit_attachment' . $order_index;
        $attachment = "";
        $path_attachment = 'attachment';
        $myclass = get_class($model);
        if ($order_index == 0) {
            $attachment = $model->attachment;
        }
        if ($order_index == 1) {
            $attachment = $model->attachment1;
        } else if ($order_index == 2) {
            $attachment = $model->attachment2;
        } elseif ($order_index == 3) {
            $attachment = $model->attachment3;
        } elseif ($order_index == 4) {
            if ($myclass == 'User') {
                $attachment = $model->photo;
            }
        } 
        if (!file_exists(Yii::getPathOfAlias('webroot') . $attachment)) {
            if ($myclass == 'User') {
                echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_dummyman.jpg">';
            } else {
                echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_photo01.jpg">';
            }
            return;
        }



        if (in_array($host_file_attachment_ext, Constants::$imgExtention)) {
            

            $filename = ltrim($attachment, '/');
            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
            if (!file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                if ($myclass == 'User') {
                    echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_dummyman.jpg">';
                } else {
                    echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_photo01.jpg">';
                }
                return;
            }
            $thumnail_file_path = ltrim($thumnail_file_path, '/');
            list($width, $height) = getimagesize($thumnail_file_path);


           
            printf(' <a  style="width:228px; height:171px;  position: relative; float:left" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img style="width:' . $width . 'px;height:' . $height . 'px;" class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');

            
        } else {
            if ($edit == true && Yii::app()->request->cookies[$cookie_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_name]->value)) {
                
                ?>
                <a style="width:228px; float:left; cursor: pointer;" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $url; ?>/download/?file_name=<?php echo Yii::app()->request->cookies[$cookie_name]->value; ?>">
            <?php
            } else {
                ?>
                    <a style="width:228px; float:left; cursor: pointer;" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $url ?>/download<?php if ($edit == true) echo 'edit'; ?>/?id=<?php echo $model->id . "&" . $order_index; ?>">
            <?php } ?>
                    <img src="<?php echo $assetsBase; ?>/css/common/img/<?php
            if ($host_file_attachment_ext == 'pdf')
                echo 'img_pdf.gif';
            else if (in_array($host_file_attachment_ext, Constants::$zipExtention))
                echo 'img_zip.gif';
            else if (in_array($host_file_attachment_ext, Constants::$excelExtention))
                echo 'img_excel.gif';
            else if (in_array($host_file_attachment_ext, Constants::$wordExtention))
                echo 'img_word.gif';
            else if (in_array($host_file_attachment_ext, Constants::$powerpointExtention))
                echo 'img_ppt.gif';
            ?>"/>

                </a>

            <?php
        }
    }

    

        /**
         * @this is crop text
         * @param model
         * @return 
         * @author Baodt
         * date: 24/07/2013
         */
        public static function crop($text, $len, $enable_br_tag = FALSE) {
            if ($enable_br_tag == FALSE) {
                $arr_replace = array("<p>", "</p>", "<b>", "</b>", "<br>", "<br />", "");
            } else {
                $arr_replace = array("<p>", "</p>", "<b>", "</b>", "");
            }

            $text = str_replace($arr_replace, "", $text);
            if ($len > strlen(utf8_decode($text))) {
                $string = $text;
            } else {
                $string_cop = mb_substr($text, 0, $len, 'UTF-8');
                $string = $string_cop . "...";
            }
            return $string;
        }

        /**
         * @This is method get employee_number wehen user login
         * @param 
         * @return employee_number
         * @author Hainhl
         */
        public static function getEmplNum() {
            return is_numeric(Yii::app()->user->name) ? Yii::app()->user->name : '';
        }

        /**
         * @This is method to check role 
         * @param 
         * @return boolean
         * @author Haipt
         */
        public static function isAdmin($bounty = null) {
            if (Yii::app()->request->cookies['id'] != NULL ) {
                $userId = Yii::app()->request->cookies['id']->value ;
                if (!empty($userId)) {
                    $user = User::model()->findByPk($userId);
                    $role_id = $user->role_id;
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand();
                    $command->select('controller');
                    $command->from(' functions f');
                    $command->join('role_management r', 'r.function_id=f.id');
                    $command->where("r.role_id=$role_id AND r.baserole_id=" . Constants::$baserole['admin']);

                    $role = $command->queryColumn();
                    if ($bounty != NULL && $bounty == true) {
                        if (is_array($role) && count($role) > 0) {
                            foreach ($role as $temp) {
                                if ($temp == 'bounty') {
                                    $role[] = 'bountyapply';
                                }
                            }
                        }
                    }

                    $function_name = Yii::app()->controller->id;
                    $pos = strpos($function_name, "admin");
                    if ($pos !== false && $function_name != "admin") {
                        $name = str_replace("admin", "", $function_name);
                        if (in_array($name, $role)) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        if ($function_name == "admin") {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
                return false;
            }
        }

        /**
         * @This is method to check view
         * @param name of controller
         * @return boolean
         * @author Haipt
         */
        public static function isViewFunction($function_name) {
            if (Yii::app()->request->cookies['id'] != NULL ) {
                $userId = Yii::app()->request->cookies['id']->value;
                $user = User::model()->findByPk($userId);
                $role_id = $user->role_id;
                $connection = Yii::app()->db;
                $command = $connection->createCommand();
                $command->select('controller');
                $command->from(' functions f');
                $command->join('role_management r', 'r.function_id=f.id');
                $command->where("r.role_id=$role_id AND r.baserole_id=" . Constants::$baserole['view']);
                $role = $command->queryColumn();
                if (in_array($function_name, $role)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        /**
         * @This is method to check post
         * @param name of controller
         * @return boolean
         * @author Haipt
         */
        public static function isPostFunction($function_name) {
            if (Yii::app()->request->cookies['id'] != NULL ) {
                $userId = Yii::app()->request->cookies['id']->value;
                $user = User::model()->findByPk($userId);
                $role_id = $user->role_id;
                $connection = Yii::app()->db;
                $command = $connection->createCommand();
                $command->select('controller');
                $command->from(' functions f');
                $command->join('role_management r', 'r.function_id=f.id');
                $command->where("r.role_id=$role_id AND r.baserole_id=" . Constants::$baserole['post']);
                $role = $command->queryColumn();
                if (in_array($function_name, $role)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        /**
         * @This is method to get list function
         * @param name of controller
         * @return array 
         * @author Haipt
         */
        public static function isAdminFunction($function_name) {
            if (Yii::app()->request->cookies['id'] != NULL ) {
                $userId = Yii::app()->request->cookies['id']->value;
                $user = User::model()->findByPk($userId);
                $role_id = $user->role_id;
                $connection = Yii::app()->db;
                $command = $connection->createCommand();
                $command->select('controller');
                $command->from(' functions f');
                $command->join('role_management r', 'r.function_id=f.id');
                $command->where("r.role_id=$role_id AND (r.baserole_id=" . Constants::$baserole['admin'] . " OR r.baserole_id=" . Constants::$baserole['post'] . ")");
                $role = $command->queryColumn();
                if (in_array($function_name, $role)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        /**
         * @This is method to get list function
         * @param name of controller
         * @return Contributor_id 
         * @author Baodt
         */
        public static function isContributorFunction($function_name) {
            if (Yii::app()->request->cookies['id'] != NULL ) {
                if (isset($_GET["id"])) {
                    if ($function_name != 'role' || $function_name != 'user') {
                        $role = Yii::app()->db->createCommand("select * from " . $function_name . " where contributor_id = " . Yii::app()->request->cookies['id']->value)->queryAll();

                        foreach ($role as $id_r) {
                            if ($id_r["id"] != "" && isset($_GET["id"])) {
                                if ($id_r["id"] == $_GET["id"]) {
                                    return true;
                                }
                            }
                        }
                    } else if ($function_name == 'role' || $function_name == 'user') {
                        return false;
                    }
                } else {
                    return true;
                }
            }
        }

    }
    