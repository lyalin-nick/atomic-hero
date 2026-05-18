<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

?>
<footer id="footer" class="mt-auto py-3 footer-sport">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="footer-admin-links">
                <?php if (Yii::$app->user->isGuest): ?>
                    <?= Html::a('Войти', ['/site/login'], ['class' => 'footer-link']) ?>
                <?php else: ?>
                    <?= Html::a('Админ-панель', ['/admin/team/index'], ['class' => 'footer-link']) ?>
                    <?= Html::a('Выйти', ['/site/logout'], [
                        'class' => 'footer-link',
                        'data-method' => 'post',
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
