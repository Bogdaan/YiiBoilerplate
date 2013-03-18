<?php

/**
 * This is the model class for table "{{feedback}}".
 *
 * The followings are the available columns in table '{{feedback}}':
 * @property integer $id
 * @property string $name
 * @property string $subject
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property integer $updated_at
 * @property integer $created_at
 */
class Feedback extends CommonModel
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return '{{feedback}}';
	}


	public function rules()
	{
		return array(
			array('name, subject, message', 'required'),
			array('is_deleted, is_visible', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('name, subject, email, phone', 'length', 'max'=>255),
			array('message', 'safe'),
			array('email', 'email'),
			array('name, subject, email, phone, message', 'safe', 'on'=>'search'),
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
			'subject' => t('Subject'),
			'email' => t('Email'),
			'phone' => t('Phone'),
			'message' => t('Message'),
			'is_visible'=> t('Is visible'),
			'is_deleted'=> t('Is deleted'),
			'created_at' => t('Created at'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->condition = 'is_deleted=0';

		$criteria->compare('name',$this->name,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getCacheDependency(){
        return new CDbCacheDependency('select max("updated_at") from {{feedback}}');
    }
}