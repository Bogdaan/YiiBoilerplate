<?php

class ReviewController extends Controller {

    public function actionIndex(){
        $criteria=new CDbCriteria;
        $criteria->order = 'ordering';
        $criteria->condition = 'is_deleted=0';

        $pages = new CPagination(Review::model()->count($criteria));
        $pages->pageSize = param('itemsPerPage', 10);
        $pages->applyLimit($criteria);

        $entities = Review::model()->cache(param('sqlCacheTime', 1000100), Review::getCacheDependency())->findAll($criteria);

        $this->render('list', array(
            'reviews' => $entities, 'pages' => $pages, $model = new Review,
        ));        
    }
    
    
    public function actionCreate(){
        $model=new Review;

        if(isset($_POST['Review']))
        {
            $model->attributes=$_POST['Review'];
            $model->is_visible = 0;
            $model->language = app()->language;
            $model->created_at = date(DateTime::W3C);

            if($model->save()){
                
                $message = new YiiMailMessage;
                $message->view = 'new-review';
                $message->setSubject(app()->name.' - new review');
                $message->setBody(array('model'=>$model), 'text/html');
                $message->addTo( param('email_to') );
                $message->from = param('email_from');
                app()->mail->send($message);
                
                $this->redirect(array('success') );
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionSuccess(){
        $this->render('success');
    }
    
}
