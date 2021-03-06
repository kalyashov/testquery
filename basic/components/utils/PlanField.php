<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 29.02.2016
 * Time: 22:01
 */

namespace app\components\utils;


class PlanField extends Enum
{
    const ID = 'id';
    const OPERATION = 'operation';
    const OBJECT_NAME = 'object_name';
    const OPTIONS = 'options';
    const ROWS = 'rows';
    const CARDINALITY = 'cardinality';
    const COST = 'cost';
    const CPU_COST = 'cpu_cost';
    const IO_COST = 'io_cost';
    const TEMP_SPACE = 'temp_space';
    const TIME = 'time';
}