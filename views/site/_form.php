<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<div class="site-_form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
    ]); ?>
    
    <?= $form->field($model, 'username')->textInput(['autofocus' => !$model->isNew]) ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>

    <?php if ($model->isNew) { ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
    <?php } ?>
    
    <?php if (!$model->isNew) { ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
    <?php } ?>

    <div class="form-group">
        <!-- <div class="offset-lg-1 col-lg-11"> -->
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <!-- </div> -->
    </div>

    <?php ActiveForm::end(); ?>
</div>