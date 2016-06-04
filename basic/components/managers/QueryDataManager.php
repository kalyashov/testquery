<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 04.04.2016
 * Time: 18:28
 */

namespace app\components\managers;


/**
 * Class DataManager
 * Обрабатывает данные запросов
 * @package app\components\managers
 */
class QueryDataManager
{
    /**
     * @param $query - данные запроса
     * @return array - массив
     */
    public static function QueryDataToArray($queryData)
    {
        $resultArray['data'] = array();

        while ($row = oci_fetch_array($queryData, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            array_push($resultArray['data'], $row);
        }

        return $resultArray;
    }

    /**
     * @param $queryData - данные запроса
     * @return JSON
     */
    public static function QueryDataToJson($queryData)
    {
     return json_encode(self::QueryDataToArray($queryData));
    }


}