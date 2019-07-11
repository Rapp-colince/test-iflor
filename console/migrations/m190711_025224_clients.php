<?php

use yii\db\Schema;
use yii\db\Migration;

class m190711_025224_clients extends Migration
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
            '{{%clients}}',
            [
                'id'=> $this->primaryKey(11)->unsigned(),
                'email'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }
}
