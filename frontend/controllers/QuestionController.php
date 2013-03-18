<?php

class QuestionController extends Controller {

    public function actionIndex(){
        $criteria=new CDbCriteria;
        $criteria->order = 'ordering';
        $criteria->condition = 'is_deleted=0';

        $pages = new CPagination(Question::model()->count($criteria));
        $pages->pageSize = param('itemsPerPage', 10);
        $pages->applyLimit($criteria);

        $entities = Question::model()->cache(param('sqlCacheTime', 1000100), Question::getCacheDependency())->findAll($criteria);

        $this->render('list', array(
            'questions' => $entities, 'pages' => $pages, 'model'=>new Question,
        ));
    }
    
    
    public function actionCreate(){
        $model=new Question;

        if(isset($_POST['Question']))
        {
            $model->attributes = $_POST['Question'];
            $model->is_visible = 0;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = $model->created_at; 

            if($model->save()){

                $message = new YiiMailMessage;
                $message->view = 'new-question';
                $message->setSubject( app()->name.' - new question' );
                $message->setBody( array('model'=>$model), 'text/html');
                $message->addTo( param('email_to') );
                $message->from = param('email_from');
                app()->mail->send($message);

                $this->redirect( array('success') );                
            }
        }

        $this->render('create', array(
            'model'=>$model,
        ));
    }
    
    
    public function actionSuccess(){
        $this->render('success');
    }
}
