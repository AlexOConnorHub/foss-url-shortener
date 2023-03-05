<?php

use app\models\Shortened;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShortenedSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shortened';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shortened-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Shortened', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $this->render('_index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>


</div>
