<?php

/**
 * This is the model class for table "{{slider_image}}".
 *
 * The followings are the available columns in table '{{slider_image}}':
 * @property integer $id
 * @property integer $slider_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property integer $ordering
 * @property integer $updated_at 
 * @property integer $created_at
 */
class SliderImage extends CActiveRecord
{
	public const MODEL = 'SliderImage';
	public const MODELTABLE = '{{slider_image}}';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return self::MODELTABLE;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('slider_id', 'required'),
			array('slider_id, is_visible, is_deleted, ordering', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('name, description, image', 'length', 'max'=>255),
			array('name, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		  'slider'=>array(self::BELONGS_TO, 'Slider', 'slider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slider_id' => t('Slider'),
			'name' => t('Name'),
			'description' => t('Description'),
			'image' => t('Image'),
			'is_visible' => t('Is visible'),
			'is_deleted' => t('Is deleted'),
			'ordering' => t('Ordering'),
			'created_at' => t('Created at'),
		);
	}


	public function search()
	{
		$criteria=self::getCriteriaActive();

		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
}