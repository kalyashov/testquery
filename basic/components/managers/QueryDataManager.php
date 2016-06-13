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
     * Преобразует данные запроса в ассоциативный массив
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
     * Преобразует данные запроса в JSON
     * @param $queryData - данные запроса
     * @return mixed - JSON
     */
    public static function QueryDataToJson($queryData)
    {
        return json_encode(self::QueryDataToArray($queryData));
    }

    /**
     * Преобразует данные, в которых имеются поля типа CLOB или BLOB, в массив
     * @param $queryData - данные запроса
     * @param $lobFields - массив с названиями полей с типом CLOB, BLOB
     * @return mixed
     */
    public static function QueryDataWithLobToArray($queryData, $lobFields)
    {
        $resultArray['data'] = array();

        while ($row = oci_fetch_array($queryData, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            array_push($resultArray['data'], $row);
        }

        foreach($lobFields as $field)
        {
            foreach($resultArray['data'] as &$row)
            {
                $row[$field] = $row[$field]->read($row[$field]->size());
            }
        }

        unset($row);

        return $resultArray;
    }

    /**
     * Преобразует данные, в которых имеются поля типа CLOB или BLOB, в JSON
     * @param $queryData - данные запроса
     * @param $lobFields - массив с названиями полей с типом CLOB, BLOB
     * @return mixed - JSON
     */
    public static function QueryDataWithLobToJson($queryData, $lobFields)
    {
        return json_encode(self::QueryDataWithLobToArray($queryData, $lobFields));
    }
}