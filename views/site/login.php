<?php

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход в админ-панель';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="login-card">
        <div class="login-card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="login-card-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Введите логин'])->label('Логин') ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль'])->label('Пароль') ?>
            <?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Запомнить меня']) ?>

            <div class="d-grid">
                <?= Html::submitButton('Войти', ['class' => 'btn login-btn btn-lg', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
