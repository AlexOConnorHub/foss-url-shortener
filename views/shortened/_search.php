<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ShortenedSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shortened-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'visit_id') ?>

    <?= $form->field($model, 'edit_uuid') ?>

    <?= $form->field($model, 'redirect_uuid') ?>

    <?php // echo $form->field($model, 'redirect_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
