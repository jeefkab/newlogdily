<?php

/**
 * This is the model class for table "friend".
 *
 * The followings are the available columns in table 'friend':
 * @property string $id
 * @property integer $from_id
 * @property integer $to_id
 * @property integer $status_id
 * @property string $send_date
 * @property string $accept_date
 */
class Friend extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Friend the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'friend';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('from_id, to_id, status_id, send_date, accept_date', 'required'),
            array('from_id, to_id, status_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, from_id, to_id, status_id, send_date, accept_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'response_friend'=>array(self::BELONGS_TO, 'Users', 'from_id' ),
            'request_friend'=>array(self::HAS_ONE, 'Users', 'to_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'from_id' => 'From',
            'to_id' => 'To',
            'status_id' => 'Status',
            'send_date' => 'Send Date',
            'accept_date' => 'Accept Date',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('from_id', $this->from_id);
        $criteria->compare('to_id', $this->to_id);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('send_date', $this->send_date, true);
        $criteria->compare('accept_date', $this->accept_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}