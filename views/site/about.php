<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        Whenever I needed a link shortener, I never found a good solution.
        The obvious next step was to create my own.
        This is that solution, enjoy.
    </p>
</div>
