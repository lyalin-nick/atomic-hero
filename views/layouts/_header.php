<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

?>
<header id="header">
    <?php NavBar::begin(
        [
            'brandLabel' => 'Атомный герой',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark navbar-sport fixed-top']
        ],
    ) ?>
    <?= Nav::widget(
        [
            'options' => ['class' => 'navbar-nav me-auto'],
            'encodeLabels' => false,
            'items' => [
                ['label' => 'Таблица результатов', 'url' => ['/site/index']],
            ],
        ],
    ) ?>
    <?php NavBar::end() ?>
</header>
