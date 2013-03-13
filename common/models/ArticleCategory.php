<?php

/**
 * This is the model class for table "{{article_category}}".
 *
 * The followings are the available columns in table '{{article_category}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $content
 * @property string $language
 * @property integer $ordering
 */
class ArticleCategory extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ArticleCategory the static model class
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
        return '{{article_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, url, content', 'required'),
            array('parent_id, ordering', 'numerical', 'integerOnly'=>true),
            array('name, url', 'length', 'max'=>50),
            array('meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
            array('language', 'length', 'max'=>2),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, name, url, meta_title, meta_description, meta_keywords, content, language', 'safe', 'on'=>'search'),
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
            'articles'=>array(self::HAS_MANY, 'Acticle', 'category_id'),
            'parrent'=>array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => t('Parent'),
            'name' => t('Name'),
            'url' => t('Url'),
            'meta_title' => t('Meta title'),
            'meta_description' => t('Meta description'),
            'meta_keywords' => t('Meta keywords'),
            'content' => t('Content'),
            'language' => t('Language'),
            'ordering' => t('Ordering'),
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
        $criteria->compare('parent_id',$this->parent_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('meta_title',$this->meta_title,true);
        $criteria->compare('meta_description',$this->meta_description,true);
        $criteria->compare('meta_keywords',$this->meta_keywords,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('language',$this->language,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    
    /**
    * return id=>name
    */
    public function getCategoryArray(){
       $cats = ArticleCategory::model()->findAll();
       $result = array();
       foreach($cats as $cat ){
            $result[ $cat->id ] = $cat->name;
       }
       return $result;
    }    
}