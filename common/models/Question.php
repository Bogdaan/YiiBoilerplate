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
 * @property string $created_at
 */
class Question extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
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
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_name, question_content, phone, email', 'required'),
			array('is_visible', 'numerical', 'integerOnly'=>true),
			array('question_name, phone, email, answer_name', 'length', 'max'=>255),
			array('language', 'length', 'max'=>2),
			array('answer_content', 'safe'),
			array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question_name, question_content, phone, email, answer_name, answer_content', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question_name' => t('Your name'),
			'question_content' => t('Question'),
			'phone' => t('Phone'),
			'email' => t('Email'),
			'answer_name' => t('Answer name'),
			'answer_content' => t('Answer content'),
			'language' => t('Language'),
			'is_visible' => t('Is visible'),
			'created_at' => t('Created at'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('question_name',$this->question_name,true);
		$criteria->compare('question_content',$this->question_content,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('answer_name',$this->answer_name,true);
		$criteria->compare('answer_content',$this->answer_content,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}