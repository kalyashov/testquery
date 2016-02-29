<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 29.02.2016
 * Time: 22:00
 */

namespace app\components\utils;


abstract class Enum {
    private $current_val;

    final public function __construct( $type ) {
        $class_name = get_class( $this );

        $type = strtoupper( $type );
        if ( constant( "{$class_name}::{$type}" )  === NULL ) {
            throw new Enum_Exception( 'Свойства '.$type.' в перечислении '.$class_name.' не найдено.' );
        }

        $this->current_val = constant( "{$class_name}::{$type}" );
    }

    final public function __toString() {
        return $this->current_val;
    }
}