<?php

class ArticleController extends Controller {

    public function actionIndex(){
        $criteria=new CDbCriteria;
        $criteria->order = 'ordering';
        $criteria->condition = 'is_deleted=0';

        $pages = new CPagination(Article::model()->count($criteria));
        $pages->pageSize = param('itemsPerPage', 10);
        $pages->applyLimit($criteria);

        $entities = Article::model()->cache(param('sqlCacheTime', 1000100), Article::getCacheDependency())->findAll($criteria);

        $this->render('list', array(
            'articles' => $entities, 'pages' => $pages
        ));
    }


    public function actionView($id=1, $url=''){
        $criteria=new CDbCriteria;
        $criteria->condition = 'is_deleted=0';

        if($url && $this->seo){
            $id = $this->seo->modelId;
        }elseif($url && !$this->seo){
            throw404();
        }
        
        $article = $model->findByPk($id, $criteria);
        if(!$article){
            throw404();
        }

        $this->render('view', array(
            'article'=>$article
        ));
    }

}
