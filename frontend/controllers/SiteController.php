<?php

namespace frontend\controllers;

use frontend\models\GeoCoords\GeoCoordsObjectNotFoundException;
use frontend\models\Weather\WeatherHttpCodeFailedException;
use frontend\models\Weather\WeatherQueryFailedException;
use frontend\models\Weather\WeatherWrongFormatException;
use yii\web\Controller;
use frontend\models\Weather;
use Exception;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $data = [];

        try{
            $data['bryanskTemperature'] = Weather::getTemperatureForCity('bryansk');
        }catch(Exception $exception){

            if($exception instanceof GeoCoordsObjectNotFoundException){
                $data['bryanskTemperatureMessage'] = 'Данный город не поддерживается';
            }elseif(
                $exception instanceof WeatherHttpCodeFailedException ||
                $exception instanceof WeatherQueryFailedException ||
                $exception instanceof WeatherWrongFormatException
            ){
                $data['bryanskTemperatureMessage'] = 'Сервис с погодой недоступен';
            }
        }

        return $this->render('index', $data);
    }

}
