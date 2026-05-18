<?php

use yii\db\Migration;

class m000000_000001_create_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'start_time' => $this->dateTime()->null(),
            'finish_time' => $this->dateTime()->null(),
            'downtime_seconds' => $this->integer()->defaultValue(0),
            'penalty_seconds' => $this->integer()->defaultValue(0),
            'total_seconds' => $this->integer()->null(),
            'place' => $this->integer()->null(),
        ]);

        $this->createTable('participant', [
            'id' => $this->primaryKey(),
            'team_id' => $this->integer()->notNull(),
            'full_name' => $this->string(255)->notNull(),
            'birth_year' => $this->integer()->notNull(),
            'workplace' => $this->string(255)->notNull(),
            'org_number' => $this->string(100)->notNull(),
        ]);

        $this->createIndex('idx-participant-team_id', 'participant', 'team_id');
        $this->addForeignKey(
            'fk-participant-team_id',
            'participant',
            'team_id',
            'team',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('participant');
        $this->dropTable('team');
    }
}
