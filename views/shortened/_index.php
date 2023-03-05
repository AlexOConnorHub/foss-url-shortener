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
        'filterModel' => Yii::$app->user->isAdmin ? $searchModel : null,
        'columns' => [
            [
                'attribute' => 'user_id',
                'visible' => Yii::$app->user->isAdmin,
                'value' => function (Shortened $model) {
                    return Yii::$app->user->username;
                }
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function (Shortened $model) {
                    return Html::a(Html::encode($model->url), $model->url, ['target' => '_blank']);
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
                'urlCreator' => function ($action, Shortened $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'uuid' => $model->edit_uuid]);
                 }
            ],
        ],
    ]); ?>


</div>
