<?php

class Form extends CWidget {

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function detail($model, $controller_name, $assetsBase, $edit = FALSE) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }       
        $host_file_attachment1_ext = strtolower(self::getFileNameExtension($model->attachment1));
        $host_file_attachment2_ext = strtolower(self::getFileNameExtension($model->attachment2));
        $host_file_attachment3_ext = strtolower(self::getFileNameExtension($model->attachment3));
        
        echo '<div class="photo">';
        
        if (trim($model->attachment1) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment1)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment1_ext, 1, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }
        if (trim($model->attachment2) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment2)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment2_ext, 2, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }
        if (trim($model->attachment3) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment3)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment3_ext, 3, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }        
        echo '</div>';        
    }

    public static function getFileNameExtension($file_name) {
        if ($file_name == null || !is_string($file_name) || trim($file_name) == "") {
            return null;
        }
        $string_array = explode(".", $file_name);
        if (count($string_array) == 1) {
            return null;
        }
        return $string_array[count($string_array) - 1];
    }

}
