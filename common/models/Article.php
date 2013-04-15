<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $id
 * @property integer $category_id
 * @property string $short_content
 * @property string $content
 * @property string $image
 * @property string $name
 * @property integer $is_onmain 
 * @property integer $is_visible
 * @property integer $is_deleted 
 * @property integer $ordering
 * @property integer $updated_at
 * @property integer $created_at
 */
class Article extends CommonModel
{
	const MODEL = 'Article';
	const MODELTABLE = '{{article}}';
	
	
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
            array('content, short_content, name', 'required'),
            array('category_id, is_deleted, is_visible, is_onmain, ordering', 'numerical', 'integerOnly'=>true),
            array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
            array('name', 'length', 'max'=>255),
            array('short_content, content', 'safe'),
            array('short_content, content, name', 'safe', 'on'=>'search'),
            array('image', 'file', 'types'=>'jpg, gif, png',  'allowEmpty' => true),
        );
    }


    public function relations()
    {
        return array(
            'category'=>array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => t('Category'),
            'short_content' => t('Short сontent'),
            'content' => t('Content'),
            'image' => t('Image'),
            'name' => t('Name'),
            'is_visible' => t('Is visible'),
            'is_onmain' => t('Is on main'),
            'is_onmain' => t('Is deleted'),
            'ordering' => t('Ordering'),
            'updated_at' => t('Updated at'),
            'created_at' => t('Created at'),
        );
    }

    public function search()
    {
        $criteria=self::getCriteriaActive();

        $criteria->compare('id',$this->id);
        $criteria->compare('short_content',$this->short_content,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}