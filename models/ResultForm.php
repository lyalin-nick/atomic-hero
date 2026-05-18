<?php

namespace app\models;

use yii\base\Model;

class ResultForm extends Model
{
    public $start_time;
    public $finish_time;
    public $downtime_minutes = 0;
    public $downtime_seconds = 0;
    public $penalty_minutes = 0;
    public $penalty_seconds = 0;

    public function rules()
    {
        return [
            [['start_time', 'finish_time'], 'required'],
            [['start_time', 'finish_time'], 'safe'],
            [['downtime_minutes', 'downtime_seconds', 'penalty_minutes', 'penalty_seconds'], 'integer', 'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'start_time' => 'Дата и время старта',
            'finish_time' => 'Дата и время финиша',
            'downtime_minutes' => 'Простой (минуты)',
            'downtime_seconds' => 'Простой (секунды)',
            'penalty_minutes' => 'Штраф (минуты)',
            'penalty_seconds' => 'Штраф (секунды)',
        ];
    }

    public function getDowntimeTotalSeconds()
    {
        return (int)$this->downtime_minutes * 60 + (int)$this->downtime_seconds;
    }

    public function getPenaltyTotalSeconds()
    {
        return (int)$this->penalty_minutes * 60 + (int)$this->penalty_seconds;
    }
}
