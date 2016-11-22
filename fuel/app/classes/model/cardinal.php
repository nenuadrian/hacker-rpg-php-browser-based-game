<?php

namespace Model;

class Cardinal extends \Model {
  public static $objective_types = array(
        1 => array('name' => 'Connect service', 'data_type' => 'service'),
        2 => array('name' => 'Crack service', 'data_type' => 'service'),
        3 => array('name' => 'Delete entity', 'data_type' => 'entity'),
        4 => array('name' => 'Execute entity', 'data_type' => 'entity'),
        7 => array('name' => 'Execute entity on service', 'data_type' => 'entity_service'),
        5 => array('name' => 'Open entity', 'data_type' => 'entity'),
        6 => array('name' => 'Transfer entity', 'data_type' => 'entity_service'),
        );
}