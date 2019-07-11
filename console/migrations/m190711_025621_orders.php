<?php

use yii\db\Schema;
use yii\db\Migration;

class m190711_025621_orders extends Migration
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
            '{{%orders}}',
            [
                'id'=> $this->primaryKey(11)->unsigned(),
                'client_id'=> $this->integer(11)->unsigned()->notNull(),
                'partner_id'=> $this->integer(11)->unsigned()->notNull(),
                'status'=> $this->smallInteger(1)->unsigned()->notNull(),
            ],$tableOptions
        );
        $this->createIndex('client_id','{{%orders}}',['client_id'],false);
        $this->createIndex('partner_id','{{%orders}}',['partner_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('client_id', '{{%orders}}');
        $this->dropIndex('partner_id', '{{%orders}}');
        $this->dropTable('{{%orders}}');
    }
}
