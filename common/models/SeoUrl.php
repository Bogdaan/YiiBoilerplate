<?php

/**
 * This is the model class for table "{{seo_url}}".
 *
 * The followings are the available columns in table '{{seo_url}}':
 * @property integer $id
 * @property integer $modelId
 * @property string $modelName
 * @property string $metaUrl
 * @property string $metaTitle
 * @property string $metaDescription
 * @property string $metaKeywords
 * @property integer $is_deleted
 * @property string $updated_at
 * @property string $created_at
 */
class SeoUrl extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return '{{seo_url}}';
	}


	public function rules()
	{
		return array(
			array('modelId, modelName, metaUrl', 'required'),
			array('modelId, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'date',  'allowEmpty'=>true, 'format'=>'yyyy-M-d H:m:s' ),
			array('modelName, metaTitle, metaDescription, metaKeywords, metaUrl', 'length', 'max'=>255),
			array('modelId, modelName, metaTitle, metaDescription, metaKeywords', 'safe', 'on'=>'search'),
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
			'modelId' => t('Model'),
			'modelName' => t('Model name'),
			'metaUrl' => t('Meta url'),
			'metaTitle' => t('Meta title'),
			'metaDescription' => t('Meta description'),
			'metaKeywords' => t('Meta keywords'),
			'is_deleted' => t('Is deleted'),
			'created_at' => t('Created at'),
			'updated_at' => t('Updated at'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->condition = 'is_deleted=0';

		$criteria->compare('modelName',$this->modelName,true);
		$criteria->compare('metaTitle',$this->metaTitle,true);
		$criteria->compare('metaDescription',$this->metaDescription,true);
		$criteria->compare('metaKeywords',$this->metaKeywords,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getCacheDependency(){
        return new CDbCacheDependency('select max(updated_at) from {{seo_url}}');
    }    

    /**
     * @return array values (metaTitle, metaK, metaD)
     */
    public static function getPageTKD($url){
        
        $seo = SeoUrl::model()
            ->cache(param('sqlCacheTime', 1000100), SeoUrl::getCacheDependency() )
            ->find('is_deleted=0 and metaUrl=:metaUrl', array(':metaUrl'=>$url) );

        if( $seo ){
            return array( $seo['metaTitle'], $seo['metaKeywords'], $seo['metaDescription'] );
        }else{
            return array( param('siteTitle'), param('siteKeywords'), param('siteDescription') );
        }
    }


    /**
     * @returm SeoUrl object
     */
    public static function getByUrl($url){
        $criteria = new CDbCriteria;
        $criteria->condition = 'metaUrl=:metaUrl';
        $criteria->params = array(':metaUrl'=>$url);

        $seo = SeoUrl::model()
            ->cache(param('sqlCacheTime', 1000100), SeoUrl::getCacheDependency() )
            ->find($criteria);

        return $seo;
    }
    
    
    public static function getCacheDependency(){
        return new CDbCacheDependency('select max("updated_at") from {{seo_url}}');
    }    
}