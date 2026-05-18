<?php

/** @var yii\web\View $this */
/** @var app\models\Team[] $teams */

use yii\helpers\Html;

$this->title = 'Таблица результатов';
?>

<div class="site-index">

    <div class="hero-sport">
        <h1>Таблица результатов</h1>
        <p>Рейтинг команд по итогам соревнования</p>
    </div>

    <div class="leaderboard-card">
        <?php if (empty($teams)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">&#127941;</div>
                <h4>Результатов пока нет</h4>
                <p>Соревнование ещё не началось или результаты не внесены</p>
            </div>
        <?php else: ?>
            <table class="table leaderboard-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Место</th>
                        <th>Команда</th>
                        <th style="width: 180px;">Время прохождения</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teams as $team): ?>
                        <?php
                            $placeClass = 'place-other';
                            if ($team->place === 1) $placeClass = 'place-1';
                            elseif ($team->place === 2) $placeClass = 'place-2';
                            elseif ($team->place === 3) $placeClass = 'place-3';
                        ?>
                        <tr>
                            <td>
                                <?php if ($team->place !== null): ?>
                                    <span class="place-badge <?= $placeClass ?>"><?= $team->place ?></span>
                                <?php else: ?>
                                    <span class="text-muted">&mdash;</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= Html::a(Html::encode($team->name), ['team/view', 'id' => $team->id], ['class' => 'team-link']) ?>
                            </td>
                            <td>
                                <span class="time-display"><?= Html::encode($team->getFormattedTotalTime()) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>
