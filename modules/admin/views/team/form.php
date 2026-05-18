<?php

/** @var yii\web\View $this */
/** @var app\models\Team $team */
/** @var app\models\Participant[] $participants */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$isNew = $team->isNewRecord;
$this->title = $isNew ? 'Добавить команду' : 'Редактировать: ' . $team->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление командами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-team-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($team, 'name')->textInput(['maxlength' => 255]) ?>

    <h3 class="mt-4">Состав участников</h3>

    <div id="participants-container">
        <?php foreach ($participants as $i => $p): ?>
            <div class="participant-row card card-body mb-2">
                <div class="row">
                    <div class="col-md-8">
                        <label>ФИО</label>
                        <?= Html::textInput("Participant[$i][full_name]", $p->full_name, ['class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm remove-participant">Удалить</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" id="add-participant" class="btn btn-outline-secondary mb-3">+ Добавить участника</button>

    <div>
        <?= Html::submitButton($isNew ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>

<?php
$this->registerJs(<<<JS
var idx = document.querySelectorAll('.participant-row').length;

document.getElementById('add-participant').addEventListener('click', function() {
    var html = '<div class="participant-row card card-body mb-2">' +
        '<div class="row">' +
        '<div class="col-md-8"><label>ФИО</label><input type="text" name="Participant[' + idx + '][full_name]" class="form-control" required></div>' +
        '<div class="col-md-4 d-flex align-items-end"><button type="button" class="btn btn-danger btn-sm remove-participant">Удалить</button></div>' +
        '</div></div>';
    document.getElementById('participants-container').insertAdjacentHTML('beforeend', html);
    idx++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-participant')) {
        var rows = document.querySelectorAll('.participant-row');
        if (rows.length > 1) {
            e.target.closest('.participant-row').remove();
        }
    }
});
JS
);
?>
