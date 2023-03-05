<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        $model = new LoginForm();
        $model->isNew = true;

        // If post, is a user signing up
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if (!$model->validate()) {
                Yii::error($model->errors);
                return $this->render('index', ['model' => $model,]);
            } else {
            }
            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->save();
            if ($user->hasErrors()) {
                Yii::error($user->errors);
                $model->addErrors($user->errors);
                return $this->render('index', ['model' => $model,]);
            }
            $model->login();
            return $this->redirect(['shortened/create']);
        }

        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSignup() {
        $model = new LoginForm();
        $model->isNew = true;

        // If post, is a user signing up
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if (!$model->validate()) {
                Yii::error($model->errors);
                return $this->render('signup', ['model' => $model,]);
            } else {
            }
            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->save();
            if ($user->hasErrors()) {
                Yii::error($user->errors);
                $model->addErrors($user->errors);
                return $this->render('signup', ['model' => $model,]);
            }
            $model->login();
            return $this->redirect(['shortened/create']);
        }

        return $this->render('signup', ['model' => $model,]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // /**
    //  * Displays contact page.
    //  *
    //  * @return Response|string
    //  */
    // public function actionContact() {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }
}
