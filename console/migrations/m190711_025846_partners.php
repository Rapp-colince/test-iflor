<?php

use yii\db\Schema;
use yii\db\Migration;

class m190711_025846_partners extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%partners}}',
            [
                'id'=> $this->primaryKey(11)->unsigned(),
                'name'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%partners}}');
    }
}
