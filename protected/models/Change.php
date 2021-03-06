<?php

class Change extends CActiveRecord {

    
    
    
    
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Hr the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'member_change';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            array('member_name', 'required', 'message' => 'Vui lòng nhập thành viên'),
            array('change_date', 'required', 'message' => 'Vui lòng nhập ngày thay đổi'),
            array('member_name', 'length', 'max' => 255),
            
            
            array('detail,from_position,from_unit,to_position,to_unit,           		
            		id,created_date',
                'follow'),
        );
    }

    public function getAllPosts() {
        $result = array('' => 'Chọn bộ phận');
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
    private function setNullForElementsNotEntered() {
        $attributes = $this->getAttributes();
        foreach ($attributes as $key => $value) {
            if (null == $value || '' == $value) {
                $this->setAttribute($key, null);
            }
        }
    }

    /**
     * beforeSave -> save
     */
    public function beforeSave() {

        
        $now = FunctionCommon::getDateTimeSys();
        if ($this->getIsNewRecord()) {
            $this->contributor_id = Yii::app()->request->cookies['id']->value;
            $this->created_date = $now;
        }
        $change_date=  $this->change_date;
        $temp=  explode("/", $change_date);
        $change_date=$temp[2].'-'.$temp[1].'-'.$temp[0];
        $this->change_date=$change_date;
        $this->last_updated_person = FunctionCommon::getEmplNum();

        $this->last_updated_date = $now;

        $this->member_name = trim($this->member_name);
        $this->detail = trim($this->detail);        

        $this->setNullForElementsNotEntered();
        return parent::beforeSave();
    }    

}