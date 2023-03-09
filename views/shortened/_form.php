<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Shortened $model */
/** @var yii\widgets\ActiveForm $form */

if (!isset($model)) {
    $model = new app\models\Shortened();
}

?>

<div class="shortened-form">
    <?php $form = ActiveForm::begin([
        'id' => 'short-form',
        'action' => ['/shortened/create'],
        'options' => ['class' => 'form-horizontal'],
    ]); ?>
    <div class="row">
        <div class="col-10">
            <?= $form->field($model, 'redirect_url', [
                'template' => "{input}\n{label}\n{error}",
                'options' => ['class' => 'form-floating'],
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control', 'placeholder' => 'https://example.com'],
            ])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-2">
            <div class="d-flex justify-content-center">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
