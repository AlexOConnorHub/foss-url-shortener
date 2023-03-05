<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shortened $model */

$this->title = 'Update Shortened ' . $model->edit_uuid;
$this->params['breadcrumbs'][] = ['label' => 'Shortened', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->edit_uuid, 'url' => ['view', 'uuid' => $model->edit_uuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shortened-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
