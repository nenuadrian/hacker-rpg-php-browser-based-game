<?php
use \Model\Hacker;

namespace Model;
class Rewards extends \Model {
    public static function claim($reward) {
        $hacker = \DB::select('experience', 'level', 'skill_points', 'money')->from('users')->where('id', $reward['user_id'])->execute()->as_array()[0];

        if ($reward['experience']) {
            $leveled_up = Hacker::add_experience($hacker, $reward['experience']);
            unset($hacker['exp_next']);
        }

        if ($reward['skill_points']) {
            $hacker['skill_points'] += $reward['skill_points'];
        }

        if ($reward['money']) {
            $hacker['money'] += $reward['money'];
        }

        if ($reward['achievements']) {
          foreach(json_decode($reward['achievements'], true) as $a)
            Achievements::award($a, $reward['user_id']);
        }

        if ($reward['train_id']) {
            $train = Train::process(\Auth::get('train'));
            Train::add_experience($train[$reward['train_id']], $reward['train_experience']);
            $hacker['train'] = json_encode($train);
        }

        Hacker::save($hacker, $reward['user_id']);
        \DB::update('reward')->set(array('claimed' => \DB::expr('NOW()')))->where('reward_id', $reward['reward_id'])->execute();
    }


    public static function give($user_id, $reward, $title) {
      $reward['user_id'] = $user_id;
      $reward['title'] = $title;
      if (isset($reward['achievements'])) $reward['achievements'] = json_encode($reward['achievements']);
      \DB::insert('reward')->set($reward)->execute();
    }
}
