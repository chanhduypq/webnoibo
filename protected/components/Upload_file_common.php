<?php

class Upload_file_common {

    public static function echoOfficePhoto($path, $for_detail) {
        $attachment = $path;
        if (!file_exists(Yii::getPathOfAlias('webroot') . $attachment)) {
            echo '';
            return;
        }
        $filename = ltrim($attachment, '/');

        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
        $thumnail_file_path = ltrim($thumnail_file_path, '/');
        if ($for_detail == 'detail') {
            $height = 400;
            $width = 600;
        } else if ($for_detail == 'index') {
            $height = 52;
            $width = 69;
        } else {
            $height = 171;
            $width = Config::IMG_WIDTH;
        }

        if ($for_detail == 'detail') {
            printf(' <a class="a_base" style="width:600px; height:400px;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
        } else if ($for_detail == 'index') {
            printf(' <a class="a_base" style="width:70px; height:52px;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
        } else {
            printf(' <a class="a_base" style="width:228px; height:171px; float:left; position: relative;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
        }
    }

    public static function echoEyeCatch($host_file_attachment_ext, $path, $for_detail) {
        $attachment = $path;
        if (!file_exists(Yii::getPathOfAlias('webroot') . $attachment)) {
            echo '';
            return;
        }
        if (in_array($host_file_attachment_ext, Constants::$imgExtention)) {

            $filename = ltrim($attachment, '/');

            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
            $thumnail_file_path = ltrim($thumnail_file_path, '/');
            if ($for_detail == 'detail') {
                $height = 400;
                $width = 600;
            } else if ($for_detail == 'index') {
                $height = 52;
                $width = 69;
            } else {
                $height = 171;
                $width = Config::IMG_WIDTH;
            }

            if ($for_detail == 'detail') {
                printf(' <a class="a_base" style="width:600px; height:400px;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img style="width:' . $width . 'px;height:' . $height . 'px;" class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
            } else if ($for_detail == 'index') {
                printf(' <a class="a_base" style="width:70px; height:52px;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img style="width:' . $width . 'px;height:' . $height . 'px;" class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
            } else {
                printf(' <a class="a_base" style="width:228px; height:171px; float:left; position: relative;" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img style="width:' . $width . 'px;height:' . $height . 'px;" class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
            }
        }
    }

    public static function echoEyeCatch_popMemberdetail($host_file_attachment_ext, $path, $for_detail) {
        $attachment = $path;
        if (!file_exists(Yii::getPathOfAlias('webroot') . $attachment)) {
            echo '';
            return;
        }
        if (in_array($host_file_attachment_ext, Constants::$imgExtention)) {

            $filename = ltrim($attachment, '/');

            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
            $thumnail_file_path = ltrim($thumnail_file_path, '/');

            $height = 171;
            $width = Config::IMG_WIDTH;

            printf('<img src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/>');
        }
    }

    public static function echoOldFile($host_file_attachment_ext, $order_index, $model, $url) {

        $attachment = "";

        $my_class = get_class($model);
        if ($order_index == 1) {
            $attachment = $model->attachment1;
        } else if ($order_index == 2) {
            $attachment = $model->attachment2;
        } elseif ($order_index == 3) {
            $attachment = $model->attachment3;
        } elseif ($order_index == 4 && $my_class == "Unit") {

            $attachment = $model->photo;
        }


        if (in_array($host_file_attachment_ext, Constants::$imgExtention)) {

            $filename = ltrim($attachment, '/');
            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
            if (!file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                return;
            }
            $thumnail_file_path = ltrim($thumnail_file_path, '/');
            list($width, $height) = getimagesize($thumnail_file_path);
//            $width = Config::IMG_WIDTH;
//            $height = 171;
//            list($width_orig, $height_orig) = getimagesize($filename);
//            $ratio_orig = $width_orig / $height_orig;
//            if ($width / $height > $ratio_orig) {
//                $width = $height * $ratio_orig;
//            } else {
//                $height = $width / $ratio_orig;
//            }
//            $image_p = imagecreatetruecolor($width, $height);
//            if ($host_file_attachment_ext == 'jpg' || $host_file_attachment_ext == 'jpeg') {
//                $image = imagecreatefromjpeg($filename);
//            } else if ($host_file_attachment_ext == 'png') {
//                $image = imagecreatefrompng($filename);
//            } else if ($host_file_attachment_ext == 'gif') {
//                $image = imagecreatefromgif($filename);
//            }
            ?>  

            <?php
//            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
//            ob_start();
//            if ($host_file_attachment_ext == 'jpg' || $host_file_attachment_ext == 'jpeg') {
//                imagejpeg($image_p, null, 100);
//            } else if ($host_file_attachment_ext == 'png') {
//                $new_image = imagecreatetruecolor($width, $height); // new wigth and height
//                imagealphablending($new_image, false);
//                imagesavealpha($new_image, true);
//                imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
//                $image = $new_image;
//                imagealphablending($image, false);
//                imagesavealpha($image, true);
//                imagepng($image);
//            } else if ($host_file_attachment_ext == 'gif') {
//                imagegif($image_p, null, 100);
//            }             
            printf(' <a  style="width:228px; height:171px;  position: relative; float:left" rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img style="width:' . $width . 'px;height:' . $height . 'px;" class="img_base" style="float:left; position: absolute; top: 0;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');

            //imagedestroy($image_p);
            ?>
            <br />
            <span style="width:228px; float:left;">
            <?php echo self::getFileNameFromValueInDatabase($attachment); ?>
            </span>
            <?php
        } else {
            ?>
            <a style="width:228px; float:left; cursor: pointer;" id="<?php echo $attachment; ?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/
                <?php
                if ($host_file_attachment_ext == 'pdf') {
                    echo 'img_pdf.gif';
                } else if (in_array($host_file_attachment_ext, Constants::$zipExtention)) {
                    echo 'img_zip.gif';
                } else if (in_array($host_file_attachment_ext, Constants::$excelExtention)) {
                    echo 'img_excel.gif';
                } else if (in_array($host_file_attachment_ext, Constants::$wordExtention)) {
                    echo 'img_word.gif';
                } else if (in_array($host_file_attachment_ext, Constants::$powerpointExtention)) {
                    echo 'img_ppt.gif';
                }
                ?>"/>

            </a>
            <br />
            <span style="width:228px; float:left;">
            <?php echo self::getFileNameFromValueInDatabase($attachment); ?>
            </span>
            <?php
        }
    }

    public static function getFileNameFromValueInDatabase($full_file_name) {
        if ($full_file_name == null || !is_string($full_file_name) || trim($full_file_name) == "") {
            return null;
        }
        $string_array = explode("/", $full_file_name);
        if (count($string_array) == 1) {
            return NULL;
        }
        $file_name = $string_array[count($string_array) - 1];
        $string_array = explode(".", $file_name);
        $file_name = '';
        for ($i = 0, $n = count($string_array) - 2; $i < $n; $i++) {
            $file_name.=$string_array[$i];
        }
        $file_name.='.' . $string_array[count($string_array) - 1];
        return $file_name;
    }

    public static function getAttachmentById($id, $attachment_index, $table_name) {
        $attachment = Yii::app()->db->createCommand()->select('attachment' . $attachment_index)->from($table_name)->where("id=$id")->queryScalar();
        
        if ($attachment == FALSE) {
            return '';
        }
        return $attachment;
    }

    public static function getFileNameExtension($file_name) {
        if ($file_name == null || !is_string($file_name) || trim($file_name) == "") {
            return null;
        }
        $string_array = explode(".", $file_name);
        if (count($string_array) == 1) {
            return null;
        }
        $ext = $string_array[count($string_array) - 1];
        return strtolower($ext);
    }

    /**
     * @param CList $validator_list
     * @param mixed $model
     * @return void 
     */
    public static function findCFileValidateAndRemove($model, &$validator_list) {
        $item1 = null;
        $item2 = null;
        if ($validator_list->count() > 0) {
            for ($i = 0, $n = $validator_list->count(); $i < $n; $i++) {
                $item = $validator_list->itemAt($i);
                if ($item instanceof CFileValidator) {
                    if ($item1 == null) {
                        $item1 = $item;
                    } else {
                        $item2 = $item;
                    }
                }
            }
        }
        if (!($item instanceof CFileValidator) && !($item2 instanceof CFileValidator)) {
            return;
        }
        self::removeFileValidate($model, $item1->attributes);
        self::removeFileValidate($model, $item2->attributes);
    }

    /**
     * @param array $attributes
     * @param mixed $model
     * @return void 
     */
    private static function removeFileValidate($model, &$attributes) {
        if ($model->attachment1_checkbox_for_deleting == '1') {
            foreach ($attributes as $key => $value) {
                if ($value == 'attachment1') {
                    unset($attributes[$key]);
                }
            }
        }
        try {
            if ($model->attachment2_checkbox_for_deleting == '1') {
                foreach ($attributes as $key => $value) {
                    if ($value == 'attachment2') {
                        unset($attributes[$key]);
                    }
                }
            }
            if ($model->attachment3_checkbox_for_deleting == '1') {
                foreach ($attributes as $key => $value) {
                    if ($value == 'attachment3') {
                        unset($attributes[$key]);
                    }
                }
            }

            if ($model->eye_catch_checkbox_for_deleting == '1') {
                foreach ($attributes as $key => $value) {
                    if ($value == 'eye_catch') {
                        unset($attributes[$key]);
                    }
                }
            }
        } catch (Exception $e) {
            
        }
    }

    

    

    

    

    
    //bao dt view workmember detail 03/09/2013
    public static function echoPhotomember($host_file_attachment_ext, $path, $count) {
        $attachment = $path;
        if (!file_exists(Yii::getPathOfAlias('webroot') . $attachment)) {
            echo '';
            return;
        }
        if (in_array($host_file_attachment_ext, Constants::$imgExtention)) {
            $filename = ltrim($attachment, '/');
            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment);
            $thumnail_file_path = ltrim($thumnail_file_path, '/');

            $width = 46;
            $height = 52;

            if ($count == '2') {
                printf('<a rel="prettyPhoto" href="' . Yii::app()->request->baseUrl . '/' . $filename . '"><img class="img_base" style="height:60px; float:left;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/></a>');
            } else {
                echo '<img style="text-align:center; height:60px;" src="' . Yii::app()->request->baseUrl . '/' . $thumnail_file_path . '"/>';
            }
        }
    }

}
?>