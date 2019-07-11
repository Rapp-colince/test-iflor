<?php

namespace frontend\models\Weather;

use Exception;

/**
 * Не верный статус HTTP ответа при обращении к API погоды
 * @property Int $cityId
 */
class WeatherHttpCodeFailedException extends Exception
{
    /**
     * @var Integer Код ответа
     */
    private $httpStatus;


    /**
     * @param Int $httpStatus
     */
    public function __construct(Int $httpStatus)
    {
        Exception::__construct('Произошла ошибка при получениеи погоды. HTTP статус '.$httpStatus);
        $this->httpStatus = $httpStatus;
    }


    /**
     * @return Int
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

}
