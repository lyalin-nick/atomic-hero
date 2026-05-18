<?php

/** @var yii\web\View $this */
/** @var app\models\Team[] $teams */

use yii\helpers\Html;

$this->title = 'Управление командами';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-team-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Участники</th>
                <th>Итоговое время</th>
                <th>Место</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?= $team->id ?></td>
                    <td><?= Html::encode($team->name) ?></td>
                    <td><?= count($team->participants) ?></td>
                    <td><?= Html::encode($team->getFormattedTotalTime()) ?></td>
                    <td><?= $team->place ?? '—' ?></td>
                    <td>
                        <?= Html::a('Редактировать', ['update', 'id' => $team->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= Html::a('Результат', ['result', 'id' => $team->id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= Html::a('Удалить', ['delete', 'id' => $team->id], [
                            'class' => 'btn btn-sm btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Удалить команду?',
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
