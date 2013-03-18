<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $id
 * @property string $question_name
 * @property string $question_content
 * @property string $phone
 * @property string $email
 * @property string $answer_name
 * @property string $answer_content
 * @property string $language
 * @property integer $is_visible
 * @property integer $updated_at
 * @property integer $created_at
 */
class Question extends CommonModel
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{question}}';
	}
    

	public function rules()
	{
		return array(
			array('question_name, question_content, phone, email', 'required'),
			array('is_visible, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('question_name, phone, email, answer_name', 'length', 'max'=>255),
			array('answer_content', 'safe'),
			array('email', 'email'),
			array('question_name, question_content, phone, email, answer_name, answer_content', 'safe', 'on'=>'search'),
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
			'question_name' => t('Your name'),
			'question_content' => t('Question'),
			'phone' => t('Phone'),
			'email' => t('Email'),
			'answer_name' => t('Answer by'),
			'answer_content' => t('Answer content'),
			'is_visible' => t('Is visible'),
			'is_visible' => t('Is deleted'),
			'updated_at' => t('Updated at'),
			'created_at' => t('Created at'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->condition = 'is_deleted=0';

		$criteria->compare('question_name',$this->question_name,true);
		$criteria->compare('question_content',$this->question_content,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('answer_name',$this->answer_name,true);
		$criteria->compare('answer_content',$this->answer_content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getCacheDependency(){
        return new CDbCacheDependency('select max("updated_at") from {{question}}');
    }
}