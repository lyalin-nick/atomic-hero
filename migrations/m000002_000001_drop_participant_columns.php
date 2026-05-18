<?php

use yii\db\Migration;

class m000002_000001_drop_participant_columns extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('participant', 'birth_year');
        $this->dropColumn('participant', 'workplace');
        $this->dropColumn('participant', 'org_number');
    }

    public function safeDown()
    {
        $this->addColumn('participant', 'birth_year', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('participant', 'workplace', $this->string(255)->notNull()->defaultValue(''));
        $this->addColumn('participant', 'org_number', $this->string(100)->notNull()->defaultValue(''));
    }
}
