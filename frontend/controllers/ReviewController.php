<?php

class ReviewController extends Controller {

    public function actionIndex(){
        $model=new Review;

        $entities = Yii::app()->db->createCommand()
            ->select('*')
            ->from('{{review}}')
            ->where('is_visible=1 and language=:lng', array('lng'=>app()->language) )
            ->order('id DESC')
            ->limit(15)
            ->queryAll();

        $this->metaTitle      = t('Reviews');
        $this->metaKeywords   = t('Reviews');
        $this->metaDescription= t('Reviews');

        $this->render('index', array(
            'model' => $model,
            'entities' => $entities,
        ) );
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
                $message->view = 'newreview';
                $message->setSubject(app()->name.' - новый отзыв');
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
