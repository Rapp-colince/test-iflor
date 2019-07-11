<?php

/**
 * @var $this yii\web\View
 * @var int $bryanskTemperature
 */

use yii\bootstrap\Alert;

$this->title = 'Тестовое задание';

echo '<div class="site-index">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Погода</h3>
            </div>
            <div class="panel-body">';

if(isset($bryanskTemperature)){
    echo ($bryanskTemperature > 0 ? '+' : '').$bryanskTemperature.'° Брянск';
}else{
    echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => ($bryanskTemperatureMessage ?? 'Ошибка при получении данных')]);
}

echo '</div>
        <div class="panel-footer text-right"><a href="https://yandex.ru/pogoda/bryansk/" target="_blank">Яндекс.Погода</a></div>
    </div>
</div>';
