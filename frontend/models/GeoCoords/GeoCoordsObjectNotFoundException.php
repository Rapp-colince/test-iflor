<?php

namespace frontend\models\GeoCoords;

use Exception;

/**
 * Координаты для города не найдены
 * @property $cityId
 */
class GeoCoordsObjectNotFoundException extends Exception
{
    /**
     * @var String Идентификатор города
     */
    private $cityId;


    /**
     * @param String $cityId
     */
    public function __construct(String $cityId)
    {
        Exception::__construct('Не найден город с идентификатором '.$cityId);
        $this->cityId = $cityId;
    }


    /**
     * @return String
     */
    public function getPageNum()
    {
        return $this->cityId;
    }

}
