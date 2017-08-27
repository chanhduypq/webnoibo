<?php

class Mood extends CActiveRecord {

   

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
        return 'mood';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            
            
            array('name','required','message'=>Lang::MSG_0002),
           
            array('name', 'length', 'max' => 256,'message'=>Lang::MSG_0012),
            array('name', 'unique', 'message' => Lang::MSG_0028),
            array('id',
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

    

    
    
    
    
    
}