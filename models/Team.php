<?php

namespace app\models;

use yii\db\ActiveRecord;

class Team extends ActiveRecord
{
    public static function tableName()
    {
        return 'team';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['start_time', 'finish_time'], 'safe'],
            [['downtime_seconds', 'penalty_seconds', 'total_seconds', 'place'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название команды',
            'start_time' => 'Время старта',
            'finish_time' => 'Время финиша',
            'downtime_seconds' => 'Время простоя (сек)',
            'penalty_seconds' => 'Штрафное время (сек)',
            'total_seconds' => 'Итоговое время (сек)',
            'place' => 'Место',
        ];
    }

    public function getParticipants()
    {
        return $this->hasMany(Participant::class, ['team_id' => 'id']);
    }

    public function getFormattedTotalTime()
    {
        if ($this->total_seconds === null) {
            return '—';
        }
        $hours = intdiv($this->total_seconds, 3600);
        $minutes = intdiv($this->total_seconds % 3600, 60);
        $seconds = $this->total_seconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function calculateResult()
    {
        if ($this->start_time && $this->finish_time) {
            $start = strtotime($this->start_time);
            $finish = strtotime($this->finish_time);
            $elapsed = $finish - $start;
            $this->total_seconds = $elapsed - (int)$this->downtime_seconds + (int)$this->penalty_seconds;
            if ($this->total_seconds < 0) {
                $this->total_seconds = 0;
            }
        }
    }

    public static function recalculatePlaces()
    {
        $teams = self::find()
            ->where(['not', ['total_seconds' => null]])
            ->orderBy(['total_seconds' => SORT_ASC])
            ->all();

        $place = 1;
        foreach ($teams as $team) {
            $team->place = $place++;
            $team->save(false);
        }

        // Reset place for teams without results
        self::updateAll(['place' => null], ['total_seconds' => null]);
    }
}
