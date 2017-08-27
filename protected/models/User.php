<?php

class User extends CActiveRecord {

    /**
     * 
     */   
    public $photo_checkbox_for_deleting;
    public $birthday_year;
    public $birthday_month;
    public $birthday_day;
    public $role_name;
	
	
	
	
    

    // Baodt password validation
    // date 30/07/2013
    public function validatePassword($passwd) {
        return $passwd == $this->passwd;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            array('role_id', 'required', 'message' => Lang::MSG_0015),
            /**
             * 
             */
            array('employee_number', 'required', 'message' => Lang::MSG_0032),
            array('division', 'required', 'message' => Lang::MSG_0129),
            array('position', 'required', 'message' => Lang::MSG_0130),
            array('mailaddr', 'required', 'message' => Lang::MSG_0018),
            array('lastname', 'required', 'message' => Lang::MSG_0024),
            array('firstname', 'required', 'message' => Lang::MSG_0025),            
            array('joindate', 'required', 'message' => Lang::MSG_0021),
            array('passwd', 'required', 'message' => Lang::MSG_0044),
            /**
             * 
             */
            array('employee_number', 'length', 'max' => 24, 'message' => Lang::MSG_0029),
            array('mailaddr', 'length', 'max' => 256),
            array('lastname', 'length', 'max' => 32),
            array('firstname', 'length', 'max' => 32),
            
           
			
            
			
            
            array('comment', 'length', 'max' => 2000),
            array('passwd', 'length', 'max' => 20, 'message' => "password không được vượt quá 20 kí tự"),
            /**
             * 
             */
//            array('passwd', 'character'),
            /**
             * 
             */
            array('photo',
                'file', 'allowEmpty' => TRUE, 'types' => '                                                          
                                                          jpg,gif,png,jpeg,
                                                          ',
                'wrongType' => Lang::MSG_0033,
            ),
            /**
             * 
             */
            array('photo',
                'file', 'allowEmpty' => TRUE, 'maxSize' => Config::MAX_FILE_SIZE * 1024 * 1024,
                'tooLarge' => 'Dung lượng file không được vượt quá' . Config::MAX_FILE_SIZE . 'MB.',
            ),
            /**
             * 
             */
            array('employee_number', 'unique', 'message' => Lang::MSG_0028),
            array('mailaddr', 'unique', 'message' => Lang::MSG_0020),
            /*
             * 
             */
            array('mailaddr', 'email', 'message' => Lang::MSG_0019),
            /**
             * 
             */
            array('joindate', 'numerical', 'integerOnly' => true, 'message' => Lang::MSG_0022),
            array('employee_number', 'numerical', 'integerOnly' => true, 'message' => Lang::MSG_0029),
            array('joindate', 'length', 'max' => 4, 'message' => Lang::MSG_0023),
            
            /**
             * 
             */
            array('     
                photo,
                photo_checkbox_for_deleting,            		
                created_date,
                birthday,    
                birthday_year,birthday_month,birthday_day,                
                role_name,
                id,
				division,				
				position,
                                chuc_vu
				
               ',
                'follow'),
        );
    }
 
    public function character($attribute) {
        if (preg_match("/^[a-zA-Z0-9]+$/", $this->$attribute) == 0) {
            $this->addError($attribute, Lang::MSG_0061);
        }
    }

    

    /**
     *
     */
    public function getAllRoles() {
        $roles = Yii::app()->db->createCommand()
                ->select(array('id', 'role_name'))
                ->from('role')
                ->queryAll()
        ;
        $result = array('' => 'Chọn quyền');
        if (is_array($roles) && count($roles) > 0) {
            foreach ($roles as $role) {
                $result[$role['id']] = $role['role_name'];
            }
        }
        return $result;
    }

    /**
     *
     */
    public function getAllBirthdayMonth() {
        $result = array();
        for ($i = 1; $i <= 12; $i++) {
            $result[$i] = $i;
        }
        return $result;
    }

    /**
     *
     */
    public function getAllBirthdayYear() {
        $result = array();
        for ($i = 1920; $i <= date('Y'); $i++) {
            $result[$i] = $i;
        }
        return $result;
    }

    /**
     *
     */
    public function getAllBirthdayDay() {
        $result = array();
        for ($i = 1; $i <= 31; $i++) {
            $result[$i] = $i;
        }
        return $result;
    }

    /**
     *
     */
    public function follow($attribute) {
        
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'employee_number' => '社員番号',
            'mailaddr' => 'メールアドレス',
            'role_id' => '役割名',
            'joindate' => '入社年',
        );
    }

    /**
     *
     */
    public function setNullForElementsNotEntered() {
        $attributes = $this->getAttributes();
        foreach ($attributes as $key => $value) {
            if (null == $value || '' == $value) {
                $this->setAttribute($key, null);
            }
        }
    }
    public function getAllPosts() {
        $result = array('' => 'Chọn bộ phận');
        return $result;
    }
    public function getAllChucVus() {
        $result = array('' => 'Chọn chức vụ');
        $position_array=  Config_position_user::$position_array;
        if(is_array($position_array)&&count($position_array)>0){
            foreach ($position_array as $key=>$value){
                $result[$key]=$value;
            }
        }
        return $result;
    }

    /**
     *
     */
    public function beforeSave() {
		
        /**
         *
         */
        $this->last_updated_person = FunctionCommon::getEmplNum();
        /**
         *
         */
        $now = FunctionCommon::getDateTimeSys();

        if ($this->getIsNewRecord()) {//insert            
            $this->created_date = $now;
        }
        $this->last_updated_date = $now;
        /**
         * 
         */
        if ($this->getIsNewRecord()) {
            $this->passwd = 'smile@gmorunsystem';
        }



        /**
         * 
         */
        $this->employee_number = trim($this->employee_number);
        $this->mailaddr = trim($this->mailaddr);
        $this->lastname = trim($this->lastname);
        $this->firstname = trim($this->firstname);
        
        $this->joindate = trim($this->joindate);
		$this->active_flag = true;
      
        
		
		$this->division = $this->division;
		$this->position = trim($this->position);
		
			
        
        
        $this->comment = trim($this->comment);
        if ($this->birthday_year != NULL && trim($this->birthday_year) != "") {
            $this->birthday = $this->birthday_year . '-' . $this->birthday_month . '-' . $this->birthday_day;
        }

        /**
         * 
         */
        /**
         * 
         */
        if ($this->getIsNewRecord() == true) {            
            if (Yii::app()->request->cookies['file_user_regist_attachment4'] != NULL) {
                $this->photo = Yii::app()->request->cookies['file_user_regist_attachment4']->value;
            } else {
                $this->photo = '';
                
            }
            unset(Yii::app()->request->cookies['file_user_regist_attachment4']);
            unset(Yii::app()->request->cookies['file_user_regist_attachment4_thumnail']);
        } else {
            if (Yii::app()->request->cookies['file_user_edit_attachment4'] != NULL) {
                $this->photo = Yii::app()->request->cookies['file_user_edit_attachment4']->value;
            }


            unset(Yii::app()->request->cookies['file_user_edit_attachment4']);
            unset(Yii::app()->request->cookies['file_user_edit_attachment4_thumnail']);


            /**
             * process attachment1
             */
            $attachment4 = Yii::app()->db->createCommand()->select('photo')->from('user')->where("id=" . $this->id)->queryScalar();

            if ($this->photo_checkbox_for_deleting == '1') {//delete
                /**
                 * delete old file if exists
                 */

                if ($attachment4 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment4)) {
                    unlink(Yii::getPathOfAlias('webroot') . $attachment4);
                    $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment4);
                    if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                        unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                    }
                }
                /**
                 * for update attachment1 field=null
                 */
                $this->photo = NULL;
            } else if ($this->photo_checkbox_for_deleting == '0') {//keep old stastus
                /**
                 * 
                 */
                if ($this->photo != $attachment4) {//upload new file
                    if ($attachment4 != "" && file_exists(Yii::getPathOfAlias('webroot') . $attachment4)) {
                        unlink(Yii::getPathOfAlias('webroot') . $attachment4);
                        $thumnail_file_path = FunctionCommon::getFilenameInThumnail($attachment4);
                        if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {
                            unlink(Yii::getPathOfAlias('webroot') . $thumnail_file_path);
                        }
                    }
                }
            }
        }
        /**
         *
         */
        $this->setNullForElementsNotEntered();
        /**
         * 
         */
        return parent::beforeSave();
    }

    

    protected function beforeValidate() {

        $this->findCFileValidateAndRemove($this->validatorList);
        return parent::beforeValidate();
    }

    /**
     * 
     */
    private function findCFileValidateAndRemove(&$validator_list) {
        if ($validator_list->count() > 0) {
            for ($i = 0, $n = $validator_list->count(); $i < $n; $i++) {
                $item = $validator_list->itemAt($i);
                if ($item instanceof CFileValidator) {
                    break;
                }
            }
        }
        if (!($item instanceof CFileValidator)) {
            return;
        }
        $this->removeFileValidate($item->attributes);
    }

    /**
     * 
     */
    private function removeFileValidate(&$attributes) {
        if ($this->photo_checkbox_for_deleting == '1') {
            foreach ($attributes as $key => $value) {
                if ($value == 'photo') {
                    unset($attributes[$key]);
                }
            }
        }
    }

    /*
     * Create Date:20130808 
     * Update Date: 
     * Author: Hai Nguyen 
     * User change: 
     * Return :Fullname
     * Description:This is method using get fullname
     * */

    public function getFullName() {
        $firstname = $this->firstname;
        $lastname = $this->lastname;
        return $lastname . ' ' . $firstname;
    }

}