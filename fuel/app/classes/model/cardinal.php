<?php

namespace Model;

class Cardinal extends \Model {
  public static $objective_types = array(
        1 => array('name' => 'Connect 2 user', 'data_type' => 'user'),
        2 => array('name' => 'Crack user', 'data_type' => 'user'),
        3 => array('name' => 'Delete entity', 'data_type' => 'entity'),
        4 => array('name' => 'Execute entity', 'data_type' => 'entity'),
        7 => array('name' => 'Execute entity on user', 'data_type' => 'entity_user'),
        5 => array('name' => 'Open entity', 'data_type' => 'entity'),
        6 => array('name' => 'Transfer entity', 'data_type' => 'entity_user'),
        8 => array('name' => 'SQL', 'data_type' => 'user', 'data2' => true)
        );
}
