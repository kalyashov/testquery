<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 28.02.2016
 * Time: 18:24
 */

namespace app\components\managers;


/**
 * Class ConnectionManager
 * @package app\components\managers
 */
class OracleConnectionManager
{
    /**
     * @param $model
     * @return resource
     */
    public static function getConnection($model)
    {
        $conn = oci_connect($model->username, $model->password,
            $model->host . '/' . $model->db_name);

        if (!$conn)
        {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        return $conn;
    }

    public static function closeConnection()
    {}

}