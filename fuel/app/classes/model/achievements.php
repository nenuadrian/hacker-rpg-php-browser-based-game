<?php

namespace Model;

class Achievements extends \Model {

   public static $achievements = array(
   		1 => array(
   			'name' => '5th time\'s the charm',
   			'description' => 'Connected to the grid 5 days in a row',
 			),
      2 => array(
   			'name' => '15th time\'s the charm',
   			'description' => 'Connected to the grid 15 days in a row',
 			),
      3 => array(
   			'name' => '30th time\'s the charm',
   			'description' => 'Connected to the grid 30 days in a row',
   			),
      4 => array(
   			'name' => '60th time\'s the charm',
   			'description' => 'Connected to the grid 60 days in a row',
 			),
      );


    public static function process($a_string = false) {
        if ($a_string) {
            $achievements = json_decode($a_string, true);
        } else $achievements = array();

        return $achievements;
    }

    public static function award($achievement_id, $user_id) {
      $user = \DB::select('achievements')->from('users')->where('id', $user_id)->execute()->as_array();
      if (count($user)) {
        $achievements = static::process($user[0]['achievements']);
        $achievements[$achievement_id] = time();
        \DB::update('users')->set(array('achievements' => json_encode($achievements)))->where('id', $user_id)->execute();
      }
    }
}
