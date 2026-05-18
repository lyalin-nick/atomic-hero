<?php

/** @var yii\web\View $this */
/** @var app\models\Team $team */

use yii\helpers\Html;

$this->title = $team->name;
$this->params['breadcrumbs'][] = ['label' => 'Таблица результатов', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = $this->title;

$formatTime = function ($seconds) {
    if ($seconds === null || $seconds === 0) {
        return '&mdash;';
    }
    $h = intdiv($seconds, 3600);
    $m = intdiv($seconds % 3600, 60);
    $s = $seconds % 60;
    return sprintf('%02d:%02d:%02d', $h, $m, $s);
};
?>

<div class="team-view">

    <div class="team-header">
        <h1><?= Html::encode($team->name) ?></h1>
        <?php if ($team->place !== null): ?>
            <div class="team-place-big">
                <span class="place-label">Место</span>
                #<?= Html::encode($team->place) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Дата и время старта</div>
            <div class="stat-value stat-value-text"><?= $team->start_time ? Html::encode($team->start_time) : '&mdash;' ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Дата и время финиша</div>
            <div class="stat-value stat-value-text"><?= $team->finish_time ? Html::encode($team->finish_time) : '&mdash;' ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Время простоя</div>
            <div class="stat-value"><?= $formatTime($team->downtime_seconds) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Штрафное время</div>
            <div class="stat-value"><?= $formatTime($team->penalty_seconds) ?></div>
        </div>
        <div class="stat-card stat-highlight">
            <div class="stat-label">Итоговое время</div>
            <div class="stat-value"><?= $team->getFormattedTotalTime() ?></div>
        </div>
        <div class="stat-card stat-highlight">
            <div class="stat-label">Итоговое место</div>
            <div class="stat-value"><?= $team->place !== null ? '#' . Html::encode($team->place) : '&mdash;' ?></div>
        </div>
    </div>

    <?php if (!empty($team->participants)): ?>
        <div class="section-title">Состав команды</div>
        <div class="participants-card">
            <table class="table participants-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>ФИО</th>
                        <th>Год рождения</th>
                        <th>Место работы / отдел</th>
                        <th>Табельный номер</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($team->participants as $i => $p): ?>
                        <tr>
                            <td><span class="participant-number"><?= $i + 1 ?></span></td>
                            <td><strong><?= Html::encode($p->full_name) ?></strong></td>
                            <td><?= Html::encode($p->birth_year) ?></td>
                            <td><?= Html::encode($p->workplace) ?></td>
                            <td><?= Html::encode($p->org_number) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
