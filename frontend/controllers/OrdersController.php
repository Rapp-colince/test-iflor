<?php

namespace frontend\controllers;

use common\models\Partners;
use Yii;
use common\models\Orders;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientModel = $model->getClient()->one();

        if(
            $model->load(Yii::$app->request->post()) &&
            $model->save() &&
            $clientModel->load(Yii::$app->request->post()) &&
            $clientModel->save()
        ){
            return $this->redirect(['update', 'id' => $model->id]);
        }

        $partners = [];
        foreach (Partners::find()->select('id, name')->asArray()->all() as $item){
            $partners[$item['id']] = $item['name'];
        }

        $products = Yii::$app->db->createCommand("SELECT products.name, orders_products.quantity FROM products INNER JOIN orders_products ON orders_products.product_id = products.id AND orders_products.order_id=:orderId")
            ->bindValue(':orderId', $model->id)
            ->queryAll();


        return $this->render('update', [
            'model' => $model,
            'partners' => $partners,
            'products' => $products,
            'totalCost' => $model->getTotalCost(),
        ]);
    }


    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
