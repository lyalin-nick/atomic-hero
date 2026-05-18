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
            [['team_id', 'full_name', 'birth_year', 'workplace', 'org_number'], 'required'],
            [['team_id', 'birth_year'], 'integer'],
            [['full_name', 'workplace'], 'string', 'max' => 255],
            [['org_number'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Команда',
            'full_name' => 'ФИО',
            'birth_year' => 'Год рождения',
            'workplace' => 'Место работы / отдел',
            'org_number' => 'Идентификационный номер',
        ];
    }

    public function getTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'team_id']);
    }
}
