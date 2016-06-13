<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 27.02.2016
 * Time: 22:50
 */

namespace app\components\managers;

use app\components\utils\DBInfo;
use app\components\utils\PlanField;
use app\components\utils\SqlStatistic;
use app\components\utils\UserObjects;
use app\components\utils\UserTables;
use app\components\utils\ExecutionPlan;
/**
 * Class QueryManager
 * Класс для осуществления запросов к БД
 * @package app\components\managers
 */
class QueryManager
{
    private $connection = null;
    private static $queryManager = null;

    // TODO генерировать statement_id
    private $sid = 'user_query_1';

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
     * Ф-я для получения информации о БД: версии и т.п.
     * @return resource
     */
    public function getDataBaseInfo()
    {
        return $this->executeQuery(DBInfo::QUERY_GET_VERSION);
    }

    /**
     * Ф-я для получения размера БД
     * @return resource
     */
    public function getDataBaseSize()
    {
        return $this->executeQuery(DBInfo::QUERY_DB_SIZE);
    }

    /**
     * Ф-я для загрузки CPU
     * @return resource
     */
    public function getCpuUsed()
    {
        return $this->executeQuery(DBInfo::QUERY_CPU_USED);
    }

    /**
     * Ф-я для получения таблиц пользователя
     * @return resource
     */
    public function getUserTables()
    {
        return $this->executeQuery(UserObjects::QUERY_GET_USER_TABLES);
    }

    public function getUserProcedures()
    {
        return $this->executeQuery(UserObjects::QUERY_GET_USER_PROCEDURES);
    }

    public function getUserTriggers()
    {
        return $this->executeQuery(UserObjects::QUERY_GET_USER_TRIGGERS);
    }

    public function getUserViews()
    {
        return $this->executeQuery(UserObjects::QUERY_GET_USER_VIEWS);
    }

    public function getQueriesByElapsedTime()
    {
        return $this->executeQuery(SqlStatistic::QUERIES_BY_ELAPSED_TIME);
    }

    public function getQueriesByCpuTime()
    {
        return $this->executeQuery(SqlStatistic::QUERIES_BY_CPU_TIME);
    }

    public function getQueriesByBufferGets()
    {
        return $this->executeQuery(SqlStatistic::QUERIES_BY_BUFFER_GETS);
    }

    public function getQueriesByParseCalls()
    {
        return $this->executeQuery(SqlStatistic::QURIES_BY_PARSE_CALLS);
    }

    public function getQueriesByExecutions()
    {
        return $this->executeQuery(SqlStatistic::QUERIES_BY_EXECUTIONS);
    }

    public function getQueriesByDiskReads()
    {
        return $this->executeQuery(SqlStatistic::QUERIES_BY_DISK_READS);
    }

    public function getExecutionPlan($sql = null, $sql_id = null)
    {
        $this->clearPlan();

        $plan['data'] = array();
        $plan['src'] = array();
        $needExplain = false;

         // Если есть SQL_ID, то можно получить план запроса по SQL_ID из V$SQL_PLAN
        if($sql_id)
        {
            $plan['data'] = $this->executeQuery(ExecutionPlan::planFromVSQL_PLAN($sql_id));
            $plan['src'] = ExecutionPlan::VSQLPLAN;
        }
        // Иначе попытаемся получить SQL_ID из V$SQL
        else if($sql)
        {
            $sqlIdData = $this->executeQuery(ExecutionPlan::sqlIdByFullText($sql));
            $sql_id = QueryDataManager::QueryDataToArray($sqlIdData)['data']['0']['SQL_ID'];

            if($sql_id)
            {
                $plan['data'] = $this->executeQuery(ExecutionPlan::planFromVSQL_PLAN($sql_id));
                $plan['src'] = ExecutionPlan::VSQLPLAN;
            }
            else
            {
                $needExplain = true;
            }
        }

        // Если план не был получен из V$SQL, то получим план с помощью команды
        // EXPLAIN PLAN FOR
        if($sql && $needExplain)
        {
            $this->executeQuery(ExecutionPlan::explainPlanForQuery($sql, $this->sid));
            $plan['data'] = $this->executeQuery(ExecutionPlan::planFromPlanTable($this->sid));
            $plan['src'] = ExecutionPlan::EXPLAIN_PLAN_FOR_SRC;
        }

        return $plan;
    }

    public function getPlanTableFor($sql)
    {
        $this->clearPlan();
        $this->explainPlanFor($sql);

        $plan = array();

        $id = $this->getPlanTableField( new PlanField('ID'), $this->sid);
        $operation = $this->getPlanTableField( new PlanField('OPERATION'), $this->sid);
        $object_name = $this->getPlanTableField( new PlanField('OBJECT_NAME'), $this->sid);
        $options = $this->getPlanTableField( new PlanField('OPTIONS'), $this->sid);
        $cardinality = $this->getPlanTableField( new PlanField('CARDINALITY'), $this->sid);
        $cost = $this->getPlanTableField( new PlanField('COST'), $this->sid);
        //$cpu_cost = $this->getPlanTableField( new PlanField('CPU_COST'), $this->sid);
        //$io_cost = $this->getPlanTableField( new PlanField('IO_COST'), $this->sid);
        //$temp_space = $this->getPlanTableField( new PlanField('TEMP_SPACE'), $this->sid);
        //$time = $this->getPlanTableField(new PlanField('TIME'), $this->sid);
        $index = 0;
        foreach($id as $row)
        {
            array_push($plan,array($id[$index], $operation[$index], $object_name[$index], $options[$index], $cardinality[$index], $cost[$index],
                ));
            $index++;
        }

        return $plan;
    }

    private function getPlanTableField(PlanField $field, $id)
    {
        $QUERY = "select " . $field . " from plan_table where statement_id='" . $id . "'";
        return $this->parsePlan($this->executeQuery($QUERY));
    }

    public function getLongRunningQueries()
    {
        $QUERY = 'SELECT * FROM (SELECT sql_fulltext, sql_id, elapsed_time, cpu_time,
                  disk_reads, executions, child_number, first_load_time, last_load_time FROM v$sql
                  ORDER BY elapsed_time DESC) WHERE ROWNUM < 10';

        $QUERY2 = 'SELECT * FROM (SELECT sql_id, elapsed_time, child_number,
                  disk_reads, executions, first_load_time, last_load_time FROM v$sql
                  ORDER BY elapsed_time DESC) WHERE ROWNUM < 10';

        $result = $this->executeQuery($QUERY);

        return $result;//$this->parseQuery($result);
    }

    public function executeQuery($query)
    {
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

    public function parseQuery($query)
    {
        $strQuery = "";
        while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            foreach ($row as $item)
            {
                $strQuery .= ($item !== null ? htmlentities($item, ENT_QUOTES) : "");
            }
        }

        return $strQuery;
    }

    public function parsePlan($plan)
    {
        $planArray = array();
        while ($row = oci_fetch_array($plan, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            foreach ($row as $item)
            {
                $str= ($item !== null ? htmlentities($item, ENT_QUOTES) : " ");
                array_push($planArray, $str);
            }
        }

        return $planArray;
    }


    private function clearPlan()
    {
        $query = "DELETE FROM PLAN_TABLE";
        $this->executeQuery($query);
    }

    private function explainPlanFor($sql)
    {
        $query = "EXPLAIN PLAN SET STATEMENT_ID = '" . $this->sid . "' FOR " . $sql;
        $this->executeQuery($query);
    }

}