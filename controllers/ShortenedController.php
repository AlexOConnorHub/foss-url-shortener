<?php

namespace app\controllers;

use app\models\Shortened;
use app\models\ShortenedSearch;
use app\models\Visit;
use app\models\VisitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ShortenedController implements the CRUD actions for Shortened model.
 */
class ShortenedController extends Controller {
    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'redirect'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user || Yii::$app->user->isAdmin;
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view', 'update', 'delete'],
                            'matchCallback' => function ($rule, $action) {
                                $uuid =  $this->request->getQueryParam('uuid');
                                if (!$uuid || !Yii::$app->user) {
                                    return false;
                                }
                                $model = Shortened::findOne(['edit_uuid' => $uuid]);
                                if ($model === null) {
                                    return false;
                                }
                                if ($model->user_id === Yii::$app->user->id) {
                                    return true;
                                }
                                if (Yii::$app->user->isAdmin) {
                                    return true;
                                }
                                if ($model->user_id === null) {
                                    return true;
                                }
                            },
                        ],

                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Shortened models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new ShortenedSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (!Yii::$app->user->isAdmin) {
            $dataProvider->query->andWhere(['user_id' => Yii::$app->user->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shortened model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($uuid) {
        $model = Shortened::findOne(['edit_uuid' => $uuid]);

        $searchModel = new VisitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['shortened_id' => $model->id]);
        
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Shortened model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Shortened();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'uuid' => $model->edit_uuid]);
            } else {
                Yii::error($model->errors);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Shortened model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($uuid) {
        $model = Shortened::findOne(['edit_uuid' => $uuid]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uuid' => $model->edit_uuid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Shortened model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($uuid) {
        $model = Shortened::findOne(['edit_uuid' => $uuid])->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shortened model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Shortened the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Shortened::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Redirects to the URL
     * @return \yii\web\Response
     */
    public function actionRedirect($uuid) {
        $shrt = Shortened::find()->where(['redirect_uuid' => $uuid])->one();

        $visit = new Visit();
        $visit->shortened_id = $shrt->id;
        $visit->ip = Yii::$app->request->userIP;
        $visit->user_agent = Yii::$app->request->userAgent;
        $str = '';
        foreach (Yii::$app->request->getAcceptableLanguages() as $lang) {
            $str .= $lang . ',';
        }
        $visit->accepted_languages = $str;
        $visit->user_id = (Yii::$app->user->id ?? null);
        $visit->created_at = date('Y-m-d H:i:s');
        $visit->save();

        Yii::$app->queue->push(new \app\jobs\VisitJob(['shortened_id' => $shrt->id, 'visit_id' => $visit->id]));
        return Yii::$app->response->redirect($shrt->redirect_url);
    }
}
