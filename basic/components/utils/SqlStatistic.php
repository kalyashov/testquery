<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 12.06.2016
 * Time: 16:19
 */

namespace app\components\utils;


/**
 * Class SqlStatistic
 * Содержит запросы для получения статистики по SQL-запросам пользователя
 * @package app\components\utils
 */
class SqlStatistic
{
    const QUERIES_BY_ELAPSED_TIME =
        'SELECT * FROM (SELECT elapsed_time, executions, cpu_time, disk_reads, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY elapsed_time DESC) WHERE ROWNUM < 11';

    const QUERIES_BY_ELAPSED_TIME_WITH_DATE =
         'SELECT * FROM (SELECT elapsed_time, executions, cpu_time, disk_reads, child_number, sql_id, module,
          sql_fulltext, first_load_time, last_load_time FROM v$sql
          ORDER BY elapsed_time DESC) WHERE ROWNUM < 11';

    const QUERIES_BY_CPU_TIME =
        'SELECT * FROM (SELECT cpu_time, executions, elapsed_time, disk_reads, child_number, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY cpu_time DESC) WHERE ROWNUM < 11';

    const QUERIES_BY_BUFFER_GETS =
        'SELECT * FROM (SELECT buffer_gets, cpu_time, executions, elapsed_time, disk_reads, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY buffer_gets DESC) WHERE ROWNUM < 11';

    const QUERIES_BY_DISK_READS =
        'SELECT * FROM (SELECT disk_reads, cpu_time, executions, elapsed_time, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY disk_reads DESC) WHERE ROWNUM < 11';

    const QUERIES_BY_EXECUTIONS =
        'SELECT * FROM (SELECT executions, rows_processed, cpu_time, elapsed_time, disk_reads, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY executions DESC) WHERE ROWNUM < 11';

    const QURIES_BY_PARSE_CALLS =
        'SELECT * FROM (SELECT parse_calls, executions, sql_id, module,
          sql_fulltext FROM v$sql
          ORDER BY parse_calls DESC) WHERE ROWNUM < 11';

}