<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'content' => function($data){
                    return '<a href="/orders/update?id='.$data->id.'" target="_blank">'.$data->id.'</a>';
                }
            ],
            [
                'label' => 'Партнер',
                'content' => function($data){
                    return $data->getPartner()->one()->name;
                }
            ],
            [
                'label' => 'Стоимость',
                'content' => function($data){
                    return $data->getTotalCost();
                }
            ],
            [
                'label' => 'Состав заказа',
                'content' => function($data){
                    $products = Yii::$app->db
                        ->createCommand("SELECT products.name FROM products INNER JOIN orders_products ON orders_products.product_id = products.id AND orders_products.order_id=:orderId")
                        ->bindValue(':orderId', $data->id)
                        ->queryAll();
                    return implode(', ', ArrayHelper::getColumn($products, 'name'));

                }
            ],
            [
                'label' => 'Статус',
                'content' => function($data){
                    return $data::STATUSES[$data->status];
                }
            ],
        ],
    ]); ?>


</div>
