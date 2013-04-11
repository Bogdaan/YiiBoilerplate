<?php

class CommonModel extends CActiveRecord {

	public static function getCacheDependency(){
		$table = static::MODELTABLE;
		new CDbCacheDependency('select max("updated_at") from '.$table);
	}

	
	public static function getCriteriaActive(){
		$c = new CDbCriteria;
		$c->addColumnCondition(array('t.is_visible'=>1, 't.is_deleted'=>0));
		return $c;
	}
	
	
	public static function getCached(){
		return CActiveRecord::model(static::MODEL)
			->cache( param('slqCacheTime', 1000100), static::getCacheDependency() );
	}
	
	
	public static function fetchOne(CDbCriteria $c){
		$c->mergeWith(static::getCriteriaActive());
		return static::getCached()->find($c);
	}
	
	
	public static function fetchAll(CDbCriteria $c){
		$c->mergeWith(static::getCriteriaActive());
		return static::getCached()->findAll($c);
	}

	
	public static function fetchById($id){
		$c = static::getCriteriaActive();
		$c->addColumnCondition(array('t.id'=>$id));
		return static::getCached()->find($c);
	}
}
