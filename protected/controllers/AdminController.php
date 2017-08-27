<?php

class AdminController extends Controller {

    public $pageTitle;
    private $module_table_array=null;

    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_TOP_ADMIN;
        if (Yii::app()->request->cookies['id'] == NULL) {

            $this->redirect(array('newgin/'));
        }              
    }

    public function actionIndex() {
        /**
         * 
         */
        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        /**
         * 
         */
        $page_size = Config::LIMIT_ROW;

        /**
         * 
         */
        $select_command = Yii::app()->db->createCommand()->select();
        /**
         * select no row
         * for using union
         */
        $select_command->select(array(
                    'id',
                    'created_date',
                    'last_updated_date',
                    "title",
                    "content",
                    "content as table_name",
                ))
                ->from('coffee')
                ->where('false')
        ;

        /**
         * 
         */
        $tablename_articleid_array = $this->getUpdateInformation($page, $page_size);
        /**
         * 
         */
        $items = array();
        if (is_array($tablename_articleid_array) && count($tablename_articleid_array) > 0) {
            foreach ($tablename_articleid_array as $tablename_articleid) {
                foreach ($tablename_articleid as $key => $value) {
                    $article_id = $key;
                    $table_name = $value;
                }
                $select_command->union("select id,created_date,last_updated_date,title,content,'$table_name' as table_name from $table_name where id=$article_id and contributor_id=" . Yii::app()->request->cookies['id']->value);
            }
            $items = $select_command->queryAll();
        }
        $item_count = $this->getUpdateInformationCount();
        /**
         * 
         */
        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);
        /**
         * 
         */
        $params = array('items' => $items,
            'item_count' => $item_count,
            'page_size' => $page_size,
            'pages' => $pages);
        /**
         * 
         */
        unset(Yii::app()->request->cookies['beforelink']);
        $this->render('index', $params);
    }

    /**
     * 
     */
    private function getUpdateInformationCount() {
        if($this->module_table_array==null){
            $this->module_table_array=array_keys(Constants::$module_tile_array);
        }  
        $module_table_array=array();
        if(is_array($this->module_table_array)&&count($this->module_table_array)>0){
            foreach ($this->module_table_array as $temp){
                $module_table_array[]="'$temp'";
            }
        }
        $string_in=  implode(",", $module_table_array);
        /**
         * 
         */
        $update_infomation_count = Yii::app()->db->createCommand()
                ->select(array(
                    'count(*) as count',
                        )
                )
                ->from('update_information')
                ->andWhere("table_name IN($string_in)")
                ->andWhere("contributor_id=" . Yii::app()->request->cookies['id']->value)
                ->queryScalar();
        if ($update_infomation_count == FALSE) {
            return 0;
        }
        return $update_infomation_count;
    }

    /**
     * 
     */
    private function getUpdateInformation($page, $page_size) {
        if($this->module_table_array==null){
            $this->module_table_array=array_keys(Constants::$module_tile_array);
        }  
        $module_table_array=array();
        if(is_array($this->module_table_array)&&count($this->module_table_array)>0){
            foreach ($this->module_table_array as $temp){
                $module_table_array[]="'$temp'";
            }
        }
        $string_in=  implode(",", $module_table_array);
        /**
         * 
         */
        $update_infomations = Yii::app()->db->createCommand()
                ->select(array(
                    'article_id',
                    'table_name',
                        )
                )
                ->from('update_information')
                ->andWhere("table_name IN($string_in)")
                ->andWhere("contributor_id=" . Yii::app()->request->cookies['id']->value)
                ->limit($page_size, ($page - 1) * $page_size)
                ->order('created_date desc')
                ->queryAll();
        /**
         * 
         */
        $tablename_articleid_array = array();
        if (is_array($update_infomations) && count($update_infomations) > 0) {

            foreach ($update_infomations as $update_infomation) {
                $tablename_articleid_array[] = array($update_infomation['article_id'] => $update_infomation['table_name']);
            }
            return $tablename_articleid_array;
        }
        return array();
    }

    /**
     * 
     */
    public function actionDelete() {
        /**
         * 
         */
        $id = Yii::app()->request->getParam("id");
        $table_name = Yii::app()->request->getParam("table_name");

        $row = Yii::app()->db->createCommand("select * from $table_name where id=$id")->queryRow();
        if (is_array($row) && count($row) > 0) {
            $this->deleteAttachments($row);
        }
        Yii::app()->db->createCommand()->delete("update_information", "article_id=$id and table_name='$table_name'");
        Yii::app()->db->createCommand()->delete("$table_name", "id=$id");
        $this->deleteComment($id, $table_name);
        $this->redirect(array('/admin/index'));
    }

    /**
     *
     */
    private function deleteComment($id, $table_name) {
        if ($table_name == 'ideas') {
            $table_name = 'ideas_comment';
            $key = 'ideas_id';
        }
        if (isset($key)) {
            Yii::app()->db->createCommand("delete from $table_name where $key=$id")->execute();
        }
    }

    /**
     *
     */
    private function deleteAttachments($row) {
        foreach ($row as $key => $value) {
            if (
                    $key == 'attachment1' || $key == 'attachment2' || $key == 'attachment3'
            ) {
                $this->deleteAttachment($value);
            }
        }
    }

    /**
     *
     */
    private function deleteAttachment($path) {
        if ($path != "" && file_exists(Yii::getPathOfAlias('webroot') . $path)) {
            unlink(Yii::getPathOfAlias('webroot') . $path);
            $thumnail_file_path = FunctionCommon::getFilenameInThumnail($path);
            if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
            }
            $widget_file_name = $this->getWidgetFileName($thumnail_file_path);
            if ($widget_file_name != '' && file_exists(Yii::getPathOfAlias('webroot') . $widget_file_name)) {
                unlink(Yii::getPathOfAlias('webroot') . $widget_file_name);
            }
        }
    }

    private function getWidgetFileName($file_name) {
        $temp = explode(".", $file_name);
        if (count($temp) == 1) {
            return '';
        }
        $widget_file_name = '';
        for ($i = 0, $n = count($temp) - 1; $i < $n; $i++) {
            if ($i < $n - 1) {
                $widget_file_name.=$temp[$i] . '.';
            } else {
                $widget_file_name.=$temp[$i];
            }
        }
        $widget_file_name.='_widget.' . $temp[count($temp) - 1];
        return $widget_file_name;
    }

}
