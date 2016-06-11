<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 11.06.2016
 * Time: 15:45
 */

namespace app\components\utils;

/**
 * Class DBInfo
 * Содержит запросы для получения информации о БД
 * @package app\components\utils
 */
class DBInfo
{
    const QUERY_GET_VERSION = 'SELECT * FROM product_component_version';

    const QUERY_DB_SIZE = 'SELECT "Reserved", "Reserved" - "Free" "Used","Free"
                          FROM( SELECT
                                (SELECT sum(bytes/(1014*1024)) from dba_data_files) "Reserved",
                                (SELECT sum(bytes/(1024*1024)) from dba_free_space) "Free"
                                FROM dual
                              )';

    const QUERY_TABLESPACES_SIZE = 'SELECT tablespace_name "Tablespace",sum(bytes)/1024/1024
                                    "Size in MB" from dba_data_files group by tablespace_name';

    const QUERY_CPU_USED = 'SELECT (a.value / b.value)*100 "CPU" FROM V$SYSSTAT a, V$SYSSTAT b
                            WHERE a.name = \'parse time cpu\' and
                            b.name = \'CPU used by this session\'';



}