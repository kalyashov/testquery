<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 13.06.2016
 * Time: 16:41
 */

namespace app\components\utils;

class ExecutionPlan
{
    const EXPLAIN_PLAN_FOR_SRC = 'EXPLAIN PLAN FOR';
    const VSQLPLAN = 'V$SQL_PLAN';

    public static function sqlIdByUniqueText($uniq_sql)
    {
        return 'SELECT SQL_ID FROM V$SQL WHERE SQL_FULLTEXT LIKE \'%' . $uniq_sql . '%\'' ;
    }

    public static function sqlIdByFullText($full_sql)
    {
        return 'SELECT SQL_ID FROM V$SQL WHERE SQL_FULLTEXT LIKE \'' . $full_sql . '\'' ;
    }

    public static function explainPlanForQuery($sql, $sid)
    {
        return "EXPLAIN PLAN SET STATEMENT_ID='" . $sid . "' FOR " . $sql;
    }

    public static function planFromVSQL_PLAN($sql_id)
    {
        return 'SELECT ID, OPERATION, OBJECT_NAME, OPTIONS, CARDINALITY, COST FROM V$SQL_PLAN WHERE SQL_ID=\'' . $sql_id . "'";
    }

    public static function planFromPlanTable($sid)
    {
        return "SELECT ID, OPERATION, OBJECT_NAME, OPTIONS, CARDINALITY, COST FROM PLAN_TABLE WHERE STATEMENT_ID='" . $sid . "'";
    }
}