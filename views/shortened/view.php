<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Shortened $model */

$this->title = $model->edit_uuid;
$this->params['breadcrumbs'][] = ['label' => 'Shortened', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shortened-view">

    <h2>Redirect <?= Html::a(Html::encode($model->url), $model->url) ?> to <?= Html::a(Html::encode($model->redirect_url), $model->redirect_url) ?> </h2>

    <p>
        <?= Html::a('Update redirect locaiton', ['update', 'uuid' => $model->edit_uuid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'uuid' => $model->edit_uuid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= $this->render("/visit/_index", [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
