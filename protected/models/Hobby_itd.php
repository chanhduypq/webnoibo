<?php

class Hobby_itd extends CActiveRecord {

    public $unit_id;
    

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
        return 'hobby_itd';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            /**
             * 
             */
           
            
            array('unit_id', 'required', 'message' => Lang::MSG_0102),            
            array('user_id', 'required', 'message' => Lang::MSG_0101),
            array('user_id', 'unique', 'message' => 'Đã tồn tại thành viên bóng đá này'),
            /**
             * 
             */
            
            /**
             * 
             */
            array('created_date,
                        id,
                        ',
                'follow'),
        );
    }

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
    public function follow($attribute) {
        
    }

   

    public function getAllUsers() {
        $result = array('' => 'Chọn nhân viên');
        return $result;
    }

    /**
     *
     */
    public function beforeSave() {
        //
        $employee_number = FunctionCommon::getEmplNum();
        $this->last_updated_person = $employee_number;
        $now = FunctionCommon::getDateTimeSys();

        if ($this->getIsNewRecord()) {//insert
            $this->created_date = $now;
            $this->contributor_id = Yii::app()->request->cookies['id']->value;
        }
        $this->last_updated_date = $now;

        


        return parent::beforeSave();
    }



}