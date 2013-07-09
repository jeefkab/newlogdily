<?php

/**
 * This is the model class for table "nodes".
 *
 * The followings are the available columns in table 'nodes':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $date_create
 * @property string $date_update
 * @property string $picture
 * @property integer $user_receive_id
 * @property integer $user_send_id
 * @property integer $category_id
 * @property string $parent_id
 */

class Nodes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nodes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nodes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('title, text, date_create, date_update, user_id, category_id, parent_id', 
                    'required', 'message'=>'กรุณากรอกช่องนี้ด้วย' ),
                array('user_id, category_id', 'numerical', 'integerOnly'=>true),
                array('title', 'length', 'max'=>255),
                //array('parent_id', 'length', 'max'=>20),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, title, text, date_create, date_update, user_id, category_id, parent_id ', 'safe', 'on'=>'search'),
                array('picture', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'insert, update'), 
            );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'users'=>array(self::BELONGS_TO, 'Users', 'user_id'),
                    'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
                    'satoo'=>array(self::HAS_MANY, 'Satoo', 'satoo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'text' => 'Text',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
                        'picture' => 'picture',
			'user_id' => 'User',
			'category_id' => 'Category',
			'parent_id' => 'Parent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('parent_id',$this->parent_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}