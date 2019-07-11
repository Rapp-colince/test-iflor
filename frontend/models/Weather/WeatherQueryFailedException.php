<?php

namespace frontend\models\Weather;

use Exception;

/**
 * Ошибка при обращении к API погоды
 * @property String $errorText
 */
class WeatherQueryFailedException extends Exception
{
    /**
     * @var String Текст ошибки
     */
    private $errorText;


    /**
     * @param String $errorText
     */
    public function __construct(String $errorText)
    {
        Exception::__construct('Произошла ошибка при получениеи погоды. '.$errorText);
        $this->errorText = $errorText;
    }


    /**
     * @return String
     */
    public function getErrorText()
    {
        return $this->errorText;
    }

}
