<?php

namespace Model;

class Achievements extends \Model {

   public static $achievements = array(
   		1 => array(
   			'name' => 'A 1',
   			'description' => 'desc',
   			),
   		2 => array(
   			'name' => 'A 1',
   			'description' => 'desc',
   			),
   	);
 

    public static function process($a_string) {
        if ($a_string) {
            $achievements = json_decode($knowledge_string, true);
        } else $achievements = array();

        return $achievements;
    }
}