<?php

/** @var yii\web\View $this */
/** @var app\models\Team $team */
/** @var app\models\ResultForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Внести результат: ' . $team->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление командами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-team-result">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'start_time')->input('datetime-local') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'finish_time')->input('datetime-local') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'downtime_minutes')->input('number', ['min' => 0]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'downtime_seconds')->input('number', ['min' => 0, 'max' => 59]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'penalty_minutes')->input('number', ['min' => 0]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'penalty_seconds')->input('number', ['min' => 0, 'max' => 59]) ?>
        </div>
    </div>

    <div class="mt-3">
        <?= Html::submitButton('Сохранить результат', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
