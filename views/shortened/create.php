<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shortened $model */

$this->title = 'Create Shortened';
$this->params['breadcrumbs'][] = ['label' => 'Shorteneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shortened-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
