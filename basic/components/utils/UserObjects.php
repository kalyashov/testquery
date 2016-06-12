<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 12.06.2016
 * Time: 15:23
 */

namespace app\components\utils;


class UserObjects
{
    const QUERY_GET_USER_TABLES = 'select table_name, num_rows, avg_space, max_trans, table_lock
                              from user_tables';

    const QUERY_GET_USER_VIEWS = 'select view_name, text, text_length, view_type from user_views';

    const QUERY_GET_USER_PROCEDURES = 'select object_name, procedure_name from user_procedures';

    const QUERY_GET_USER_TRIGGERS = 'select trigger_name, trigger_type, triggering_event, table_name, column_name,
                                trigger_body, action_type, status from user_triggers';

}