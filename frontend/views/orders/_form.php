<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
/* @var $partners */
/* @var $products */
/* @var $totalCost */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model->getClient()->one(), 'email')->textInput() ?>

    <?= $form->field($model, 'partner_id')->dropDownList($partners) ?>

    <div class="well">
        <?php
        foreach($products as $item){
            echo $item['name'].' ('.$item['quantity'].' шт)<br/>';
        }
        ?>
    </div>


    <?= '<div class="well">Статус: '.$model::STATUSES[$model->status].'</div>' ?>

    <?= '<div class="well">Стоимость: '.$totalCost.'</div>' ?>

    <div class="form-group"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></div>

    <?php ActiveForm::end(); ?>

</div>
