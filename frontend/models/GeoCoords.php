<?php

namespace frontend\models;

use frontend\models\GeoCoords\GeoCoordsObjectNotFoundException;

/**
 * Модель для работы с гегорафическими координатами
 */
class GeoCoords
{

    /**
     * Географические координаты для городов
     */
    const TOWN_GEO_COORDS = [
        'bryansk' => ['lat'=>53.243562, 'lon'=>34.363407],
    ];


    /**
     * Получаем географические координаты для города по его идентификатору
     * @param String $cityId Идентификатор города
     * @return array
     * @throws GeoCoordsObjectNotFoundException
     */
    public static function getCoords(String $cityId)
    {
        if(!isset(self::TOWN_GEO_COORDS[$cityId])){
            throw new GeoCoordsObjectNotFoundException($cityId);
        }else{
            return self::TOWN_GEO_COORDS[$cityId];
        }
    }

}
