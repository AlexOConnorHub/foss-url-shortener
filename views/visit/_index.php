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
                'attribute' => 'created_at',
                'label' => 'Date',
                'format' => 'datetime',
            ],
            'ip',
            'user_agent',
            'accepted_languages',
            'country_code',
            'isp',
            [
                'attribute' => 'user_id',
                'visible' => Yii::$app->user->isAdmin,
            ]
        ],
    ]); ?>
</div>
