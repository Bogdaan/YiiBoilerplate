<?php

/**
 * This is the model class for table "{{article_category}}".
 *
 * The followings are the available columns in table '{{article_category}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $content
 * @property integer $ordering
 * @property integer $is_deleted
 */
class ArticleCategory extends CommonModel
{
	const MODEL = 'ArticleCategory';
	const MODELTABLE = '{{article_category}}';

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
            array('name, content', 'required'),
            array('parent_id, ordering, is_deleted', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('name, content', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'articles'=>array(self::HAS_MANY, 'Acticle', 'category_id'),
            'parrent'=>array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => t('Parent'),
            'name' => t('Name'),
            'content' => t('Content'),
            'ordering' => t('Ordering'),
            'is_deleted' => t('Is deleted'),
        );
    }


    public function search()
    {
        $criteria=self::getCriteriaActive();

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('content',$this->content,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
    * @return id=>name
    */
    public function getCategoryArray(){
       $cats = ArticleCategory::model()->find('is_deleted=0');
       $result = array();
       foreach($cats as $cat ){
            $result[ $cat->id ] = $cat->name;
       }
       return $result;
    }    
}