<?php

/**
 * This is the model class for table "{{review}}".
 *
 * The followings are the available columns in table '{{review}}':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property integer $updated_at 
 * @property integer $created_at
 */
class Review extends CommonModel
{
	const MODEL = 'Review';
	const MODELTABLE = '{{review}}';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return self::MODELTABLE;
	}


	public function rules()
	{
		return array(
			array('name, email, message, phone', 'required'),
			array('is_visible, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('name, email, phone', 'length', 'max'=>255),
			array('message', 'safe'),
			array('name, email, phone, message', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => t('Name'),
			'email' => t('Email'),
			'phone' => t('Phone'),
			'message' => t('Message'),
			'is_visible' => t('Is visible'),
			'is_deleted' => t('Is deleted'),
			'created_at' => t('Created at'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->contition = 'is_deleted=0';

		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}