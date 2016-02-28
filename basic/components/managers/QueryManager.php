<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 27.02.2016
 * Time: 22:50
 */

namespace app\components\managers;

/**
 * Class QueryManager
 * @package app\components\managers
 */
class QueryManager
{
    private $connection = null;
    private static $queryManager = null;

    public static function getInstance($con)
    {
        if(QueryManager::$queryManager == null)
        {
            QueryManager::$queryManager = new QueryManager($con);
        }

        return QueryManager::$queryManager;
    }

    private function __construct($con)
    {
        $this->connection = $con;
    }

    /**
     * get all user queries
     * @return array
     */
    public function getAllQueries()
    {

    }

    public function createPlanTable()
    {

    }

    public function getPlanTableFor($sql)
    {
        // Подготовка выражения
        $stid = oci_parse($this->connection, 'Explain plan for ' . $sql);

        if (!$stid)
        {
            $e = oci_error($this->connection);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        // Выполним логику запроса
        $r = oci_execute($stid);
        if (!$r)
        {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        return $this->selectFromPlanTable();
    }

    private function selectFromPlanTable()
    {
        $query = "SELECT * FROM TABLE(dbms_xplan.display())";

        $stid = oci_parse($this->connection, $query);

        if (!$stid)
        {
            $e = oci_error($this->connection);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        // Выполним логику запроса
        $r = oci_execute($stid);
        if (!$r)
        {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        return $stid;
    }
}