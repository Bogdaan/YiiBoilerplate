<?php

class QuestionController extends Controller {

    public function actionIndex(){
        $model=new Question;

        $entities = app()->db->createCommand()
            ->select('*')
            ->from('{{question}}')
            ->where('is_visible=1 and language=:lng', array('lng'=>app()->language) )
            ->order('id DESC')
            ->limit(15)
            ->queryAll();        
        
        $this->metaTitle      = t('Questions');
        $this->metaKeywords   = t('Questions');
        $this->metaDescription= t('Questions');

        $this->render('index', array(
            'entities' => $entities,
            'model'=>$model,
        ) );
    }
    
    
    public function actionCreate(){
        $model=new Question;

        if(isset($_POST['Question']))
        {
            $model->attributes=$_POST['Question'];
            $model->is_visible = 0;
            $model->language = app()->language;
            $model->created_at = date(DateTime::W3C);

            if($model->save()){
                
                $message = new YiiMailMessage;
                $message->view = 'newquestion';
                $message->setSubject(app()->name.' - новый вопрос');
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
