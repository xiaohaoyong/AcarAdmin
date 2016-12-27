<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\rbac\LoginForm;
use app\models\ContactForm;

class SiteController extends BaseController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $model = new LoginForm();
        
        $adminId = \Yii::$app->session->get('adminId');
        
        if($adminId){
            return Yii::$app->response->redirect(["/"]);
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->renderPartial('login', ['model' => $model]);
        }
        
        $model->load(\Yii::$app->request->post(), '');
        $model->validate();
        $model->login();
        if ($model->getErrors()) {
            $error = array_values($model->FirstErrors)[0];
            return $this->renderPartial('/site/error', ['name' => 'Error', 'message' => $error]);
        }
        
        // 登录成功
        return Yii::$app->response->redirect(["/"]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        if(!\Yii::$app->session->isActive){
            \Yii::$app->session->open();
        }        
        
        \Yii::$app->session->destroy();        
        
        return Yii::$app->response->redirect(["/site/login"]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

}
