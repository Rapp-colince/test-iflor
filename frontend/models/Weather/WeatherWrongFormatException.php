<?php

namespace frontend\models\Weather;

use Exception;

/**
 * Ошибка при распарсинге данных, пришедших из API погоды
 * @property String $data
 */
class WeatherWrongFormatException extends Exception
{
    /**
     * @var String поступившие данные
     */
    private $data;


    /**
     * @param String $data
     */
    public function __construct(String $data = '')
    {
        Exception::__construct('Ответ API погоды не соответствует ожидаемуму формату. '.$data);
        $this->data = $data;
    }


    /**
     * @return String
     */
    public function getData()
    {
        return $this->data;
    }

}
