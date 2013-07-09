<?php

/**
 * This is the model class for table "notify".
 *
 * The followings are the available columns in table 'notify':
 * @property integer $id
 * @property string $message
 * @property integer $Isreaded
 * @property integer $type_id
 * @property integer $node_id
 * @property integer $datetime_noti
 */
class Notify extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notify the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notify';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('message, Isreaded, type_id', 'required'),
            array('Isreaded, type_id', 'numerical', 'integerOnly' => true),
            array('message', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, message, Isreaded, type_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'notify'=>array(self::BELONGS_TO, 'Users', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'message' => 'Message',
            'Isreaded' => 'Isreaded',
            'type_id' => 'Type',
            'node_id' => 'Node',
            'datetime_noti' => 'datetime_noti',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('Isreaded', $this->Isreaded);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('node_id', $this->node_id);
		$criteria->compare('datetime_noti', $this->datetime_noti);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}