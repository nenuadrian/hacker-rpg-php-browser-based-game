<?php

namespace Model;

class Hacker extends \Model {

    public static function add_experience(&$hacker, $exp) {
        $hacker['exp_next'] = Hacker::experience($hacker['level'] + 1);
        $leveled_up = false;
        while($hacker['experience'] >= $hacker['exp_next']) {
            $hacker['level'] += 1;
            $hacker['experience'] -= $hacker['exp_next'];
            $hacker['exp_next'] = Hacker::experience($hacker['level'] + 1);
            $leveled_up = true;
        }
        return $leveled_up;
    }

    public static function save($data, $user_id = false) {
        if (!$user_id) $user_id = \Auth::get('id'); if (!$user_id) return false;
        \DB::update('users')->set($data)->where('id', $user_id)->execute();
    }

    public static function experience($level) { return $level * 10; }

    public static function get_by_username($username) {
        try {
            return \DB::select('username', 'id', 'hacker_group_id', 'level', 'achievements')->from('users')->where('username', $username)->execute()[0];
        } catch(Exception $e) {}
        return false;
    }
}