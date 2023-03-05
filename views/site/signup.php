<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"> <?= Yii::$app->params['siteName'] ?> </h1>
    </div>

    <div class="body-content">
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render('/site/_form', ['model' => $model]) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
