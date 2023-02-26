<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Visit $model */

$this->title = 'Create Visit';
$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
