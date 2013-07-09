<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property integer $age
 * @property string $sex
 * @property string $address
 * @property string $email
 * @property string $telephone
 * @property string $permission
 * @property string $picture
 */
class Users extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('firstname, lastname, username, password, age, sex, 
                address, email, telephone, permission', 'required' ),
            
            array('firstname, lastname, username, password, age, sex, 
                address, email, telephone, permission ', 
                'filter', 'filter'=>'trim'),
            
            array('age', 'numerical', 'integerOnly' => true),
            array('firstname, lastname, username, password, picture', 'length', 'max' => 255),
			//array('username, email', 'unique', array('className'=> 'Users', 'message'=>'zzz') ),
			array('username', 'unique', 'message'=> 'ชื่อล๊อกอินนี้มีผู้ใช้แล้ว' ),
			array('email', 'unique', 'message'=> 'อีเมลนี้มีผู้ใช้แล้ว' ),
            array('sex', 'length', 'max' => 6),
            array('email', 'length', 'max' => 150),
            array('email', 'email' ),
            array('telephone', 'length', 'max' => 13),
            array('permission', 'length', 'max' => 5),
			
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, firstname, lastname, username, password, age, sex, address, email, telephone, permission, picture', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'nodes'=>array(self::HAS_MANY, 'Nodes', 'id'),
            'satoo'=>array(self::HAS_MANY, 'Satoo', 'satoo_id'),
            'group'=>array(self::BELONGS_TO, 'Group', 'id'),
			
            'response_friend'=>array(self::BELONGS_TO, 'Friend', 'id' ),
            'request_friend'=>array(self::HAS_ONE, 'Friend', 'id'),
			
            'notify'=>array(self::BELONGS_TO, 'Notify', 'notify_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password' => 'Password',
            'age' => 'Age',
            'sex' => 'Sex',
            'address' => 'Address',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'permission' => 'Permission',
            'picture' => 'Picture',
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
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('age', $this->age);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('permission', $this->permission, true);
        $criteria->compare('picture', $this->picture, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}