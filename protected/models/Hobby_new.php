<?php

class Hobby_new extends CActiveRecord {

    
    public $attachment1_checkbox_for_deleting;
    
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Token the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'hobby_new';
    }

    

    /*     * no validate checkbox delete is check */

    protected function beforeValidate() {
        Upload_file_common::findCFileValidateAndRemove($this, $this->validatorList);
        return parent::beforeValidate();
    }

    /**
     * remove Validate
     */
    private function removeFileValidate(&$attributes) {
        if ($this->attachment1_checkbox_for_deleting == '1') {
            foreach ($attributes as $key => $value) {
                if ($value == 'attachment1') {
                    unset($attributes[$key]);
                }
            }
        }
        
    }

    public function rules() {
        return array(
            
            
            array('title', 'required', 'message' => Lang::MSG_0002),
            array('title', 'length', 'max' => 256),
            array('content', 'required', 'message' => Lang::MSG_0003),
            array('attachment1',
                'file', 'allowEmpty' => true,
                'types' => 'jpg,gif,png,jpeg',
                'wrongType' => Lang::MSG_0004),
            array('attachment1,attachment2,attachment3',
                'file', 'allowEmpty' => true, 'maxSize' => Config::MAX_FILE_SIZE * 1024 * 1024,
                'tooLarge' => Lang::MSG_0005),
            array('attachment1,
		attachment1_checkbox_for_deleting,		
		created_date,id,id', 'follow'),
        );
    }

    public function trimText($str) {
        $str = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $str);
        return $str;
    }

    public function follow($attribute) {
        
    }

    /*     * * */

    private function setNullForElementsNotEntered() {
        $attributes = $this->getAttributes();
        foreach ($attributes as $key => $value) {
            if (null == $value || '' == $value) {
                $this->setAttribute($key, null);
            }
        }
    }

    public function beforeSave() {
        
        $now_for_record = FunctionCommon::getDateTimeSys();

        if ($this->isNewRecord) {
            $this->created_date = $now_for_record;
            $this->contributor_id = Yii::app()->request->cookies['id']->value;
        }
        $employee_number = FunctionCommon::getEmplNum();
        $this->last_updated_person = $employee_number;
        $this->last_updated_date = $now_for_record;

        if ($this->getIsNewRecord() == true) {
            if (Yii::app()->request->cookies['file_hobby_new_regist_attachment1'] != NULL) {
                $this->attachment1 = Yii::app()->request->cookies['file_hobby_new_regist_attachment1']->value;
            } else {
                $this->attachment1 = '';
            }
            
            unset(Yii::app()->request->cookies['file_hobby_new_regist_attachment1']);
            unset(Yii::app()->request->cookies['file_hobby_new_regist_attachment1_thumnail']);
            
        } else {
            if (Yii::app()->request->cookies['file_hobby_new_edit_attachment1'] != NULL) {
                $this->attachment1 = Yii::app()->request->cookies['file_hobby_new_edit_attachment1']->value;
            }

            
            unset(Yii::app()->request->cookies['file_hobby_new_edit_attachment1']);
            unset(Yii::app()->request->cookies['file_hobby_new_edit_attachment1_thumnail']);
            

            /**
             * process attachment1
             */
            $attachment1 = Upload_file_common::getAttachmentById($this->id, 1, 'hobby_new');
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
            
        }
        $this->setNullForElementsNotEntered();
        return parent::beforeSave();
    }

    /*     * save update information* */

    public function afterSave() {
        $data = array(
            'type' => 2,
            'table_name' => 'hobby_new',
            'article_id' => $this->id,
            'contributor_id' => $this->contributor_id,
            'created_date' => $this->created_date,
            'last_updated_date' => $this->last_updated_date,
        );
        
        if ($this->getIsNewRecord()) {
            Yii::app()->db->createCommand()
                    ->insert('update_information', $data);
        } 
        
    }
	 
	 /**
     * trim Start
     */
    private function trimStart($string) {
        if ($string === null || !is_string($string) || trim($string) == "") {
            return $string;
        }
        $start = 0;
        while ($string[$start] == ' ') {
            $start++;
        }
        return substr($string, $start);
    }

    /**
     * trim End
     */
    private function trimEnd($string) {
        if ($string === null || !is_string($string) || trim($string) == "") {
            return $string;
        }
        $end = strlen($string) - 1;
        $count = 0;
        while ($string[$end] == ' ') {
            $end--;
            $count++;
        }
        return substr($string, 0, strlen($string) - $count);
    }

    /**
     * trim Start And Trim End
     */
    private function trimStartAndTrimEnd($string) {

        if ($string === null || !is_string($string) || trim($string) == "") {
            return $string;
        }
        $string = $this->trimStart($string);
        $string = $this->trimEnd($string);
        return $string;
    }

}