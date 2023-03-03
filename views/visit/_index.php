<?php

use app\models\Visit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\VisitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="visit-_index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'format' => 'raw',
                'attribute' => 'id',
                'value' => function (Visit $model) {
                    return Yii::$app->user->isAdmin
                        ? Html::a($model->id, Url::toRoute(['/visit/view', 'id' => $model->id]))
                        : $model->id;
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'shortened_id',
                'value' => function (Visit $model) {
                    return $model->shortened ? Html::a($model->shortened->url, Url::toRoute(['/shortened/view', 'id' => $model->shortened->id])) : null;
                }
            ],
            'country_code',
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => function (Visit $model) {
                    return $model->user ? Html::a($model->user->username, Url::toRoute(['/user/view', 'id' => $model->user->id])) : null;
                }
            ],
            'ip',
            'user_agent',
            'accepted_languages',
            'created_at',
            'isp',
        ],
    ]); ?>
</div>
