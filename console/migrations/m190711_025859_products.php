<?php

use yii\db\Schema;
use yii\db\Migration;

class m190711_025859_products extends Migration
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
            '{{%products}}',
            [
                'id'=> $this->primaryKey(11)->unsigned(),
                'name'=> $this->string(255)->notNull(),
                'price'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
