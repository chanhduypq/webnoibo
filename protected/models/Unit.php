<?php
class Unit extends CActiveRecord {
	
	
    
    
    public $attachment1_checkbox_for_deleting;
    public $attachment2_checkbox_for_deleting;
    public $attachment3_checkbox_for_deleting;
    
    /**
     * 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated dataunit table name
     */
    public function tableName() {
        return 'unit';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            array('unit_name','required','message'=>"Vui lòng nhập tên chi nhánh"),  
            array('unit_name', 'unique', 'message' => "Chi nhánh này đã tồn tại"),
            array('mailaddr', 'unique', 'message' => "Email này đã tồn tại"),
			array('unit_name', 'length', 'max' => 256),       
			array('mailaddr', 'length', 'max' => 256),   
			array('mailaddr', 'email', 'message' => Lang::MSG_0019),  
	
			array('catchphrase', 'length', 'max' => 128),       
            array('attachment1,attachment2,attachment3',
                'file', 'allowEmpty' => true, 'types' => '
                                                          doc,docx,
                                                          xls,xlsx,
                                                          ppt,pptx,                                                          
                                                          pdf,
                                                          zip,rar,
                                                          jpg,gif,png,jpeg,
                                                          ',
                'wrongType' => Lang::MSG_0004,
            ),
            array('attachment1,attachment2,attachment3',
                'file', 'allowEmpty' => true, 'maxSize' => Config::MAX_FILE_SIZE * 1024 * 1024,
                'tooLarge' => Lang::MSG_0005,
            ),
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
    public function trimText($str) {
        $str = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $str);
        return $str;
    }
    /**
     *
     */
    private function setNullForElementsNotEntered() {
        $attributes = $this->getAttributes();        
        foreach ($attributes as $key => $value) {
            if ((null == $value || '' == $value)&&$key!='unit_name') {                
                $this->setAttribute($key, null);
            }
        }
    }

    /**
     *
     */
    public function beforeSave() {  
	 
		
          
		
                $this->unit_name    = trim($this->unit_name);
                
        
		
        $this->mailaddr     = trim($this->mailaddr);
        $this->catchphrase  = trim($this->catchphrase);
        $this->introduction = trim($this->introduction);
		$this->active_flag=true;

        if ($this->getIsNewRecord()) {//insert
            $this->created_date = FunctionCommon::getDateTimeSys();
        }    
        $this->last_updated_date = FunctionCommon::getDateTimeSys();
        $this->last_updated_person = FunctionCommon::getEmplNum();
        
        if ($this->getIsNewRecord()) {//insert
            $this->created_date = FunctionCommon::getDateTimeSys();
            $max_dispaly_order=Yii::app()->db->createCommand()->select("max(display_order) as max")->from("unit")->queryScalar();
            if($max_dispaly_order==FALSE||$max_dispaly_order=='0'){
                $max_dispaly_order=1;
            }
            else{
                $max_dispaly_order++;
            }
            $this->display_order=$max_dispaly_order;
			
			if (Yii::app()->request->cookies['file_unit_regist_attachment1'] != null) {
                $this->attachment1 = Yii::app()->request->cookies['file_unit_regist_attachment1']->value;
            } else {
                $this->attachment1 = '';
            }
            if (Yii::app()->request->cookies['file_unit_regist_attachment2'] != null) {
                $this->attachment2 = Yii::app()->request->cookies['file_unit_regist_attachment2']->value;
            } else {
                $this->attachment2 = '';
            }
            if (Yii::app()->request->cookies['file_unit_regist_attachment3'] != null) {
                $this->attachment3 = Yii::app()->request->cookies['file_unit_regist_attachment3']->value;
            } else {
                $this->attachment3 = '';
            }
            unset(Yii::app()->request->cookies['file_unit_regist_attachment1']);
            unset(Yii::app()->request->cookies['file_unit_regist_attachment2']);
            unset(Yii::app()->request->cookies['file_unit_regist_attachment3']);
			unset(Yii::app()->request->cookies['file_unit_regist_attachment1_thumnail']);
            unset(Yii::app()->request->cookies['file_unit_regist_attachment2_thumnail']);
            unset(Yii::app()->request->cookies['file_unit_regist_attachment3_thumnail']);
        }
		else{
			if (Yii::app()->request->cookies['file_unit_edit_attachment1'] != null) {
                $this->attachment1 = Yii::app()->request->cookies['file_unit_edit_attachment1']->value;
            }

            if (Yii::app()->request->cookies['file_unit_edit_attachment2'] != null) {
                $this->attachment2 = Yii::app()->request->cookies['file_unit_edit_attachment2']->value;
            }

            if (Yii::app()->request->cookies['file_unit_edit_attachment3'] != null) {
                $this->attachment3 = Yii::app()->request->cookies['file_unit_edit_attachment3']->value;
            }
            unset(Yii::app()->request->cookies['file_unit_edit_attachment1']);
            unset(Yii::app()->request->cookies['file_unit_edit_attachment2']);
            unset(Yii::app()->request->cookies['file_unit_edit_attachment3']);
			unset(Yii::app()->request->cookies['file_unit_edit_attachment1_thumnail']);
            unset(Yii::app()->request->cookies['file_unit_edit_attachment2_thumnail']);
            unset(Yii::app()->request->cookies['file_unit_edit_attachment3_thumnail']);

            /**
             * process attachment1
             */
            $attachment1 = Upload_file_common::getAttachmentById($this->id, 1, 'unit');
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
            $attachment2 = Upload_file_common::getAttachmentById($this->id, 2, 'unit');
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
            $attachment3 = Upload_file_common::getAttachmentById($this->id, 3, 'unit');
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
	/**
     *  no validate file checkbox=on
     */
    protected function beforeValidate() {
        Upload_file_common::findCFileValidateAndRemove($this, $this->validatorList);
        return parent::beforeValidate();
    }
}