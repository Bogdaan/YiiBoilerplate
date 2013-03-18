<?php

/**
 * This is the model class for table "{{new}}".
 *
 * The followings are the available columns in table '{{new}}':
 * @property integer $id
 * @property string $name
 * @property string $short_content
 * @property string $content
 * @property string $image
 * @property integer $is_onmain
 * @property integer $is_visible
 * @property integer $is_deleted
 * @property integer $ordering
 * @property integer $updated_at
 * @property integer $created_at
 */
class News extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return '{{new}}';
	}


	public function rules()
	{
		return array(
			array('name, content', 'required'),
			array('is_onmain, is_visible, is_deleted, ordering', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('name, image', 'length', 'max'=>255),
			array('short_content, updated_at', 'safe'),
			array('name, short_content, content', 'safe', 'on'=>'search'),
			array('image', 'file', 'types'=>'jpg, gif, png',  'allowEmpty' => true),
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
			'short_content' => t('Short Content'),
			'content' => t('Content'),
			'image' => t('Image'),
			'is_onmain' => t('Is onmain'),
			'is_visible' => t('Is visible'),
			'is_deleted' => t('Is deleted'),
			'ordering' => t('Ordering'),
			'updated_at' => t('Updated at'),
			'created_at' => t('Created at'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->condition = 'is_deleted=0';

		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getCacheDependency(){
        return new CDbCacheDependency('select max("updated_at") from {{new}}');
    }
}