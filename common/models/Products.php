<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 *
 * @property OrdersProducts[] $ordersProducts
 */
class Products extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'integer', 'min' => 0, 'max' => 4294967295],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::class, ['product_id' => 'id']);
    }
}
