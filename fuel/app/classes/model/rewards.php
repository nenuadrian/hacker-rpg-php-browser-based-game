<?php
use \Model\Hacker;

namespace Model;
class Rewards extends \Model {

    public static function claim($reward) {
        $hacker = \DB::select('experience', 'level', 'skill_points', 'data_points')->from('users')->where('id', $reward['user_id'])->execute()->as_array()[0];

        if ($reward['experience']) {
            $leveled_up = Hacker::add_experience($hacker, $reward['experience']);
            unset($hacker['exp_next']);
        }

        if ($reward['skill_points']) {
            $hacker['skill_points'] += $reward['skill_points'];
        }

        if ($reward['data_points']) {
            $hacker['data_points'] += $reward['data_points'];
        }


        Hacker::save($hacker, $reward['user_id']);
        \DB::update('reward')->set(array('claimed' => \DB::expr('NOW()')))->where('reward_id', $reward['reward_id'])->execute();
    }
}