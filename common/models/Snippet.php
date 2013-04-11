<?php

/**
 * This is the model class for table "{{snippet}}".
 *
 * The followings are the available columns in table '{{snippet}}':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $language
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property integer $updated_at
 * @property integer $created_at
 */
class Snippet extends CommonModel
{
	public const MODEL = 'Snippet';
	public const MODELTABLE = '{{snippet}}';

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
			array('content', 'required'),
			array('is_visible, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('name', 'length', 'max'=>255),
			array('content', 'safe'),
			array('name, content', 'safe', 'on'=>'search'),
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
			'name' => t('Snippet location'),
			'content' => t('Content'),
			'language' => t('Language'),
			'is_visible' => t('Is visible'),
			'is_deleted' => t('Is deleted'),
			'created_at' => t('Created at'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}