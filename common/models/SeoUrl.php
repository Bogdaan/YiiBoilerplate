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
class SeoUrl extends CommonModel
{
	const MODEL = 'SeoUrl';
	const MODELTABLE = '{{seo_url}}';

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
		$criteria=self::getCriteriaActive();

		$criteria->compare('modelName',$this->modelName,true);
		$criteria->compare('metaTitle',$this->metaTitle,true);
		$criteria->compare('metaDescription',$this->metaDescription,true);
		$criteria->compare('metaKeywords',$this->metaKeywords,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    /**
     * @return array values (metaTitle, metaK, metaD)
     */
    public static function getPageTKD($url){
        $c = new CDbCriteria;
		$c->addColumnCondition(array('metaUrl'=>$url));
		
        $seo = SeoUrl::fetchOne($c);

        if( $seo ){
            return array( $seo->metaTitle, $seo->metaKeywords, $seo->metaDescription );
        }else{
            return array( param('siteTitle'), param('siteKeywords'), param('siteDescription') );
        }
    }


    /**
     * @returm SeoUrl object
     */
    public static function getByUrl($url){
        $c = new CDbCriteria;
		$c->addColumnCondition(array('metaUrl'=>$url));
        $seo = SeoUrl::fetchOne($c);
        return $seo;
    }

}