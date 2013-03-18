<?php

class Controller extends CController {

	public $breadcrumbs = array();
	public $menu = array();
    
    public $seo;
    public $metaTitle='', $metaKeywords='', $metaDescription=''; 

    function init(){
        $url = Yii::app()->request->getUrl();
        $this->seo = SeoUrl::getByUrl($url);
        if($this->seo){
            $this->metaTitle = $this->seo['metaTitle'];
            $this->metaKeywords = $this->seo['metaKeywords'];
            $this->metaDescription = $this->seo['metaDescription'];
        }else{
            $this->metaTitle = param('siteTitle');
            $this->metaKeywords = param('siteKeywords');
            $this->metaDescription = param('siteDescription');
        }

        parent::init();
    }

}
