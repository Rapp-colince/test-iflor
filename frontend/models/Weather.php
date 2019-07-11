<?php

namespace frontend\models;

use yii;
use frontend\models\GeoCoords\GeoCoordsObjectNotFoundException;
use frontend\models\Weather\WeatherQueryFailedException;
use frontend\models\Weather\WeatherHttpCodeFailedException;
use frontend\models\Weather\WeatherWrongFormatException;

/**
 * Модель для работы с погодой
 */
class Weather
{

    /**
     * Получаем данные о погоде в городе по его идентификатору
     * @param String $cityId Идентификатор города
     * @return object
     * @throws GeoCoordsObjectNotFoundException
     * @throws WeatherHttpCodeFailedException
     * @throws WeatherQueryFailedException
     * @throws WeatherWrongFormatException
     */
    public static function getWeatherForCity(String $cityId)
    {
        $coords = GeoCoords::getCoords($cityId);

        $curlInit = curl_init();
        $options = [
            CURLOPT_URL => 'https://api.weather.yandex.ru/v1/forecast?lat='.$coords['lat'].'&lon='.$coords['lon'],
            CURLOPT_HTTPHEADER => [
                'X-Yandex-API-Key: '.Yii::$app->params['yandexApiKey']
            ],
            CURLOPT_HEADER => false,
            CURLOPT_NOBODY => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
        ];
        curl_setopt_array($curlInit, $options);
        $response = curl_exec($curlInit);
        $curlError = curl_error($curlInit);
        $curlErrno = curl_errno($curlInit);
        $curlInfo = curl_getinfo($curlInit);
        curl_close($curlInit);


        if($curlError!==''){
            throw new WeatherQueryFailedException("CURL error.\tcurl_error=".$curlError);
        }
        if($curlErrno!==0){
            throw new WeatherQueryFailedException("CURL error\tcurl_errno=".print_r($curlErrno, true));
        }

        if($curlInfo['http_code'] !== 200){
            throw new WeatherHttpCodeFailedException($curlInfo['http_code']);
        }

        $weatherData = json_decode($response);
        if(is_null($weatherData)){
            throw new WeatherWrongFormatException($response);
        }

        return $weatherData;
    }


    /**
     * Получаем погоду для определнного города
     * @param String $cityId Идентификатор города
     * @return Int Температура в градусах по Цельсию
     * @throws WeatherHttpCodeFailedException
     * @throws WeatherQueryFailedException
     * @throws WeatherWrongFormatException
     * @throws GeoCoordsObjectNotFoundException
     */
    public static function getTemperatureForCity(String $cityId)
    {
        $weatherData = self::getWeatherForCity($cityId);
        if(!isset($weatherData->fact->temp) || !is_int($weatherData->fact->temp)){
            throw new WeatherWrongFormatException();
        }else{
            return $weatherData->fact->temp;
        }
    }

}
