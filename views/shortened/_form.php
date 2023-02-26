<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Shortened $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shortened-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'visit_id')->textInput() ?>

    <?= $form->field($model, 'edit_uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect_uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
