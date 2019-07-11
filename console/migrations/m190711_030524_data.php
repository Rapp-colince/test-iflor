<?php

use yii\db\Migration;

/**
 * Class m190711_030524_data
 */
class m190711_030524_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand("INSERT INTO `clients` (`id`, `email`) VALUES
            (1, 'client1@yandex.ru22'),
            (2, 'client2@yandex.ru');")->execute();

        Yii::$app->db->createCommand("INSERT INTO `orders` (`id`, `client_id`, `partner_id`, `status`) VALUES
            (1, 1, 2, 1),
            (2, 1, 2, 2),
            (3, 2, 2, 1);")->execute();

        Yii::$app->db->createCommand("INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `quantity`) VALUES
            (1, 1, 1, 1),
            (2, 1, 2, 2),
            (3, 3, 2, 5);")->execute();


        Yii::$app->db->createCommand("INSERT INTO `partners` (`id`, `name`) VALUES
            (1, 'Партнер 1'),
            (2, 'Партнер 2');")->execute();

        Yii::$app->db->createCommand("INSERT INTO `products` (`id`, `name`, `price`) VALUES
            (1, 'Продукт 1', 10),
            (2, 'Продукт 2', 100);")->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('clients');
        $this->truncateTable('orders');
        $this->truncateTable('orders_products');
        $this->truncateTable('partners');
        $this->truncateTable('products');
    }


}
