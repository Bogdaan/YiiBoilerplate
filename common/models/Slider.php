<?php

/**
 * This is the model class for table "{{slider}}".
 *
 * The followings are the available columns in table '{{slider}}':
 * @property integer $id
 * @property integer $stype
 * @property string $position
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property string $updated_at
 * @property string $created_at
 */
class Slider extends CommonModel
{
	public const MODEL = 'Slider';
	public const MODELTABLE = '{{slider}}';

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
			array('stype, is_visible, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true),
			array('position', 'length', 'max'=>255),
			array('stype, position', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
		  'slides'=>array(self::HAS_MANY, 'SliderImage', 'slider_id'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'stype' => t('Type'),
			'position' => t('Position'),
			'is_visible' => t('Is visible'),
			'is_deleted' => t('Is deleted'),
		);
	}


	public function search()
	{
		$criteria=self::getCriteriaActive();

		$criteria->compare('stype',$this->stype);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 
}