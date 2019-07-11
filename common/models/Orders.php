<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $client_id
 * @property int $partner_id
 * @property int $status
 *
 * @property Clients $client
 * @property Partners $partner
 * @property OrdersProducts[] $ordersProducts
 */
class Orders extends ActiveRecord
{

    /**
     * Статусы заказа
     */
    const STATUS_NEW = 1;
    const STATUS_CURRENT = 2;
    const STATUS_DONE = 3;
    const STATUS_OVERDUE = 4;
    const STATUSES = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_CURRENT => 'Текущий',
        self::STATUS_DONE => 'Выполнен',
        self::STATUS_OVERDUE => 'Просрочен',
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'partner_id', 'status'], 'required'],
            [['client_id', 'partner_id', ], 'integer', 'min' => 0, 'max' => 4294967295],
            ['status', 'in', 'range'=>array_keys(self::STATUSES)],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Partners::class, 'targetAttribute' => ['partner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'partner_id' => 'Partner ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::class, ['id' => 'client_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partners::class, ['id' => 'partner_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::class, ['order_id' => 'id']);
    }


    /**
     * Получаем стоимость всех продуктов в заказе
     * @return float|int
     */
    public function getTotalCost(){
        $costTotal = 0;
        $ordersProducts = OrdersProducts::find()->select(['product_id', 'quantity'])->where(['order_id'=>$this->id])->asArray()->all();
        foreach ($ordersProducts as $productData){
            $costTotal += $productData['quantity'] * Products::find()->select('price')->where(['id'=>$productData['product_id']])->scalar();
        }
        return $costTotal;
    }
}
