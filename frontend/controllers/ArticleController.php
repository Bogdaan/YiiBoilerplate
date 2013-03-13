<?php

class ArticleController extends Controller {

    public function actionIndex() {
        $entities = Article::model()->findLast(10);
    
        $this->metaTitle      = t('Articles');
        $this->metaKeywords   = t('Articles');
        $this->metaDescription= t('Articles');
    
        $this->render('viewcategory', array(
            'entities' => $entities,
        ) );
    }


    public function actionView($url=null) {
        $entity = Article::model()->findArticleByUrl($url);
    
        if(empty($entity)){
            throw new CHttpException(404, t('Required page not found') );
        }
        
        $this->metaTitle      = $entity['meta_title'];
        $this->metaKeywords   = $entity['meta_keywords'];
        $this->metaDescription= $entity['meta_description'];
    
        $this->render('viewarticle', array(
            'entity' => $entity,
        ) );
    }


    public function actionViewcategory($url=null) {
        $entity  = ArticleCategory::model()->find('url=:url', array(':url'=>$url) );

        if(empty($entity)){
            throw new CHttpException(404, t('Required page not found') );
        }

        $entities = ArticleCategory::model()->findCategoryArticlesById($entity->id, 1, 10);

        if(empty($entities)){
            throw new CHttpException(404, t('Required page not found') );
        }

        $this->metaTitle      = $entity['meta_title'];
        $this->metaKeywords   = $entity['meta_keywords'];
        $this->metaDescription= $entity['meta_description'];            

        $this->render('viewcategory', array(
            'entities' => $entities,
        ) );
    }

}
