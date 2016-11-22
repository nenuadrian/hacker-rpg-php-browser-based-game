<?php

namespace Model;

class Group extends \Model {

   
    public static function create($user_id, $name) {
        $group = array(
            'name' => $name
            );
         \DB::insert('hacker_group')->set($group)->execute();
         $g_id = \DB::select('hacker_group_id')->from('hacker_group')->where('name', $name)->execute()->as_array()[0]['hacker_group_id'];
         \Hacker::save(array('hacker_group_id' => $g_id), $user_id);

         return $g_id;
    }

    public static function get($g_id) {
        try {
            return \DB::select()->from('hacker_group')->where('hacker_group_id', $g_id)->execute()[0];
        } catch(Exception $e) {}
        return false;
    }
}