<?php

/**
 * This is the model class for table "{{seo}}".
 */
class Seo extends CommonModel
{
	public const MODEL = 'Seo';
	public const MODELTABLE = '{{seo}}';

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
            array('param_name, param_value', 'required'),
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
            'param_name'=>t('Parameter name'),
            'param_value'=>t('Parameter value'),
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('param_name', $this->param_name);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}