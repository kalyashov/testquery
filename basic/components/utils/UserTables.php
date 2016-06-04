<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 29.02.2016
 * Time: 22:01
 */

namespace app\components\utils;


class UserTables extends Enum
{
    const TABLE_NAME = 'table_name';
    const NUM_ROWS = 'num_rows';
    const AVG_SPACE = 'avg_space';
    const MAX_TRANS = 'max_trans';
    const TABLE_LOCK = 'table_lock';

    const QUERY_GET_USER_TABLES = 'select table_name, num_rows, avg_space, max_trans, table_lock from user_tables';
}