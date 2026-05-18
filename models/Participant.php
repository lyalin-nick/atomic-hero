<?php

namespace app\models;

use yii\db\ActiveRecord;

class Participant extends ActiveRecord
{
    public static function tableName()
    {
        return 'participant';
    }

    public function rules()
    {
        return [
            [['team_id', 'full_name'], 'required'],
            [['team_id'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Команда',
            'full_name' => 'ФИО',
        ];
    }

    public function getTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'team_id']);
    }
}
