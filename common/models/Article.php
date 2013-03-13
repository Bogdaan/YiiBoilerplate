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
 * @property string $url
 * @property string $external_url
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $language
 * @property integer $is_visible
 * @property integer $is_onmain
 * @property integer $ordering
 * @property string $updated_at
 * @property string $created_at
 */
class Article extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Article the static model class
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
        return '{{article}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content, name, url, meta_title, meta_description, meta_keywords, is_visible', 'required'),
            array('category_id, is_visible, is_onmain, ordering', 'numerical', 'integerOnly'=>true),
            array('image', 'length', 'max'=>75),
            array('language', 'length', 'max'=>2),
            array('name, url, external_url', 'length', 'max'=>50),
            array('meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
            array('short_content, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, category_id, short_content, content, name, url, external_url, meta_title, meta_description, meta_keywords', 'safe', 'on'=>'search'),
            array('image', 'file', 'types'=>'jpg, gif, png',  'allowEmpty' => true),
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
            'category'=>array(self::BELONGS_TO, 'ArticleCategory', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => t('Category'),
            'short_content' => t('Short сontent'),
            'content' => t('Content'),
            'image' => t('Image'),
            'name' => t('Name'),
            'url' => t('Url'),
            'external_url' => t('External url'),
            'meta_title' => t('Meta title'),
            'meta_description' => t('Meta description'),
            'meta_keywords' => t('Meta keywords'),
            'language' => t('Language'),
            'is_visible' => t('Is visible'),
            'is_onmain' => t('Is on main'),
            'ordering' => t('Ordering'),
            'updated_at' => t('Updated at'),
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
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('short_content',$this->short_content,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('external_url',$this->external_url,true);
        $criteria->compare('meta_title',$this->meta_title,true);
        $criteria->compare('meta_description',$this->meta_description,true);
        $criteria->compare('meta_keywords',$this->meta_keywords,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public function findByUrl($url){
            $query = "select a.*, ac.url as category_url, ac.name as category_name, ac.content as category_content
            from  {{article}} as a join {{article_category}} as ac
                on ac.id=a.category_id
            where
                a.is_visible=1 and
                a.`url`=:url
            limit 1";

            $command = Yii::app()->db->createCommand($query);
            $command->bindParam(":url", $url, PDO::PARAM_STR);
            $entity = $command->queryRow();

            return $entity;
    }

    public function findLast($page, $perpage=10){
        $page = intval($page);
        $perpage = intval($perpage);

        $limitR = $perpage;
        $limitL = ($page-1)*$perpage;

        $query = "select a.*, ac.url as category_url, ac.name as category_name, ac.content as category_content
        from  {{article}} as a join {{article_category}} as ac
            on ac.id=a.category_id
        where 
            a.is_visible=1
        order by a.ordering
        limit {$limitL}, {$limitR}";

        $command = Yii::app()->db->createCommand($query);
        $entities = $command->queryAll();

        return $entities;
    }

}