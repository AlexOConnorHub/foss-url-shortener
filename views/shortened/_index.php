<?php

use app\models\Shortened;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShortenedSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="shortened-_index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => (Yii::$app->user->identity ? Yii::$app->user->identity->isAdmin : false) ? $searchModel : null,
        'columns' => [
            [
                'attribute' => 'user_id',
                'visible' => (Yii::$app->user->identity ? Yii::$app->user->identity->isAdmin : false),
                'value' => function (Shortened $model) {
                    if ($model->user_id === null) {
                        return 'NA';
                    }
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'redirect_url',
                'label' => 'Link to',
                'format' => 'raw',
                'value' => function (Shortened $model) {
                    return Html::a(Html::encode($model->redirect_url), $model->redirect_url, ['target' => '_blank']);
                }
            ],
            [
                'label' => "Manage link",
                'format' => 'raw',
                'attribute' => 'edit_uuid',
                'value' => function (Shortened $model) {
                    $base = Url::base(true);
                    $url = Url::toRoute(['shortened/view', 'uuid' => $model->edit_uuid]);
                    return Html::a($base . $url, $url);
                }
            ],
            [
                'label' => "Visits",
                'value' => function (Shortened $model) {
                    return $model->getVisits()->count();
                },
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, Shortened $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'uuid' => $model->edit_uuid]);
                 }
            ],
        ],
    ]); ?>


</div>
