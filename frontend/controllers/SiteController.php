<?php

class SiteController extends Controller {

	public function accessRules() {
		return array(
			array('allow', 'actions' => array('index', 'captcha', 'login', 'error', 'KK')),
			array('allow', 'users' => array('@')),
			array('deny'),
		);
	}


	public function actions() {
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	
	public function actionIndex() {
		$this->render('index');
	}


	public function actionError() {
		if ($error = app()->errorHandler->error) {
			if (app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionLogin() {
		$model = new LoginForm;

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			app()->end();
		}

		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login())
				$this->redirect(app()->user->returnUrl);
		}
		
		$this->render('login', array('model' => $model));
	}


	public function actionLogout() {
		app()->user->logout();
		$this->redirect(app()->homeUrl);
	}


}