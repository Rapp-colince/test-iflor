<?php

use yii\db\Schema;
use yii\db\Migration;

class m190711_025830_orders_products extends Migration
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
            '{{%orders_products}}',
            [
                'id'=> $this->primaryKey(11)->unsigned(),
                'order_id'=> $this->integer(11)->unsigned()->notNull(),
                'product_id'=> $this->integer(11)->unsigned()->notNull(),
                'quantity'=> $this->smallInteger(5)->unsigned()->notNull(),
            ],$tableOptions
        );
        $this->createIndex('order_id','{{%orders_products}}',['order_id'],false);
        $this->createIndex('product_id','{{%orders_products}}',['product_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('order_id', '{{%orders_products}}');
        $this->dropIndex('product_id', '{{%orders_products}}');
        $this->dropTable('{{%orders_products}}');
    }
}
