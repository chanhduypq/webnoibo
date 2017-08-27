<?php

class Post extends CActiveRecord {

    /**
     * 
     */
    public $attachment1_checkbox_for_deleting;
    public $attachment2_checkbox_for_deleting;
    public $attachment3_checkbox_for_deleting;
    
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            array('post_name','required','message'=>"Vui lòng nhập tên bộ phận"), 
            array('unit_id', 'required', 'message' => Lang::MSG_0129),
            array('post_name', 'length', 'max' => 256,'message'=>"Tên bộ phận không được vượt quá 256 kí tự"),  

            array('attachment1,attachment2,attachment3,
					attachment1_checkbox_for_deleting,
					attachment2_checkbox_for_deleting,
					attachment3_checkbox_for_deleting,            		
            		introduction,id,created_date', 'follow'),
        );
    }
    public function follow($attribute) {}
    





/**
     *
     */
    private function setNullForElementsNotEntered() {
        $attributes = $this->getAttributes();
        foreach ($attributes as $key => $value) {
            if (null == $value || '' == $value) {
                $this->setAttribute($key, null);
            }
        }
    }

    /**
     *
     */
    public function beforeSave() {        
        $now = FunctionCommon::getDateTimeSys();        
        $employee_number = FunctionCommon::getEmplNum();
        
        if ($this->getIsNewRecord()) {//insert
            $this->created_date = $now;      
            
        }
        
        $this->last_updated_person= $employee_number;
        $this->last_updated_date = $now;
        
        $this->post_name = trim($this->post_name);
        
        if ($this->getIsNewRecord()) {//insert
            $this->created_date = FunctionCommon::getDateTimeSys();
            
			
			if (Yii::app()->request->cookies['file_post_regist_attachment1'] != null) {
                $this->attachment1 = Yii::app()->request->cookies['file_post_regist_attachment1']->value;
            } else {
                $this->attachment1 = '';
            }
            if (Yii::app()->request->cookies['file_post_regist_attachment2'] != null) {
                $this->attachment2 = Yii::app()->request->cookies['file_post_regist_attachment2']->value;
            } else {
                $this->attachment2 = '';
            }
            if (Yii::app()->request->cookies['file_post_regist_attachment3'] != null) {
                $this->attachment3 = Yii::app()->request->cookies['file_post_regist_attachment3']->value;
            } else {
                $this->attachment3 = '';
            }
            unset(Yii::app()->request->cookies['file_post_regist_attachment1']);
            unset(Yii::app()->request->cookies['file_post_regist_attachment2']);
            unset(Yii::app()->request->cookies['file_post_regist_attachment3']);
			unset(Yii::app()->request->cookies['file_post_regist_attachment1_thumnail']);
            unset(Yii::app()->request->cookies['file_post_regist_attachment2_thumnail']);
            unset(Yii::app()->request->cookies['file_post_regist_attachment3_thumnail']);
        }
		else{
			if (Yii::app()->request->cookies['file_post_edit_attachment1'] != null) {
                $this->attachment1 = Yii::app()->request->cookies['file_post_edit_attachment1']->value;
            }

            if (Yii::app()->request->cookies['file_post_edit_attachment2'] != null) {
                $this->attachment2 = Yii::app()->request->cookies['file_post_edit_attachment2']->value;
            }

            if (Yii::app()->request->cookies['file_post_edit_attachment3'] != null) {
                $this->attachment3 = Yii::app()->request->cookies['file_post_edit_attachment3']->value;
            }
            unset(Yii::app()->request->cookies['file_post_edit_attachment1']);
            unset(Yii::app()->request->cookies['file_post_edit_attachment2']);
            unset(Yii::app()->request->cookies['file_post_edit_attachment3']);
			unset(Yii::app()->request->cookies['file_post_edit_attachment1_thumnail']);
            unset(Yii::app()->request->cookies['file_post_edit_attachment2_thumnail']);
            unset(Yii::app()->request->cookies['file_post_edit_attachment3_thumnail']);

            /**
             * process attachment1
             */
            $attachment1 = Upload_file_common::getAttachmentById($this->id, 1, 'post');
            if ($this->attachment1_checkbox_for_deleting == '1') {//delete
                /**
                 * delete old file if exists
                 */

                if ($attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment1)) {
                    unlink(Yii::getPathOfAlias('webroot') . $attachment1);
                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment1);
                    if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                        unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                    }
                }
                /**
                 * for update attachment1 field=null
                 */
                $this->attachment1 = NULL;
            } else if ($this->attachment1_checkbox_for_deleting == '0') {//keep old stastus
                /**
                 * 
                 */
                if ($this->attachment1 != $attachment1) {//upload new file
                    if ($attachment1 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment1)) {
                        unlink(Yii::getPathOfAlias('webroot') . $attachment1);
                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment1);
                        if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                            unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                        }
                    }
                }
            }
            /**
             * process attachment2
             */
            $attachment2 = Upload_file_common::getAttachmentById($this->id, 2, 'post');
            if ($this->attachment2_checkbox_for_deleting == '1') {//delete
                /**
                 * delete old file if exists
                 */

                if ($attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment2)) {
                    unlink(Yii::getPathOfAlias('webroot') . $attachment2);
                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment2);
                    if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                        unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                    }
                }
                /**
                 * for update attachment1 field=null
                 */
                $this->attachment2 = NULL;
            } else if ($this->attachment2_checkbox_for_deleting == '0') {//keep old stastus
                /**
                 * 
                 */
                if ($this->attachment2 != $attachment2) {//upload new file
                    if ($attachment2 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment2)) {
                        unlink(Yii::getPathOfAlias('webroot') . $attachment2);
                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment2);
                        if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                            unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                        }
                    }
                }
            }
            /**
             * process attachment3
             */
            $attachment3 = Upload_file_common::getAttachmentById($this->id, 3, 'post');
            if ($this->attachment3_checkbox_for_deleting == '1') {//delete
                /**
                 * delete old file if exists
                 */

                if ($attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment3)) {
                    unlink(Yii::getPathOfAlias('webroot') . $attachment3);
                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment3);
                    if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                        unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                    }
                }
                /**
                 * for update attachment1 field=null
                 */
                $this->attachment3 = NULL;
            } else if ($this->attachment3_checkbox_for_deleting == '0') {//keep old stastus
                /**
                 * 
                 */
                if ($this->attachment3 != $attachment3) {//upload new file
                    if ($attachment3 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment3)) {
                        unlink(Yii::getPathOfAlias('webroot') . $attachment3);
                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment3);
                        if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                            unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                        }
                    }
                }
            }
        }  
        
        $this->setNullForElementsNotEntered();
        
       
        return parent::beforeSave();
    }

    

    

   
    
    
    
    
}