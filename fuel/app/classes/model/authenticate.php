<?php

namespace Model;

class Authenticate extends \Model {
  public static function process_login() {

    // daily login
    $today = \Date::forge(time())->format("%Y-%m-%d");
    $yesterday = \Date::forge(strtotime('-1 day', time()))->format("%Y-%m-%d");

    if (\Auth::get('daily_login_last')) {
      $login_last = \Date::forge(strtotime(\Auth::get('daily_login_last')))->format("%Y-%m-%d");
    } else {
      $login_last = \Date::forge(0)->format("%Y-%m-%d");
    }

    if ($login_last != $today) {
      $updateData = array(
        'daily_login_last' => $today,
        'daily_login_count' => 1
      );
      if ($login_last == $yesterday) {
        $updateData['daily_login_count'] = \Auth::get('daily_login_count') + 1;
        if ($updateData['daily_login_count'] == 5) Rewards::give(\Auth::get('id'), array('achievements' => array(1)), "5th time's the charm");
        if ($updateData['daily_login_count'] == 15) Rewards::give(\Auth::get('id'), array('achievements' => array(2)), "15th time's the charm");
        if ($updateData['daily_login_count'] == 30) Rewards::give(\Auth::get('id'), array('achievements' => array(3)), "30th time's the charm");
        if ($updateData['daily_login_count'] == 60) Rewards::give(\Auth::get('id'), array('achievements' => array(4)), "60th time's the charm");
      }
      Hacker::save($updateData, \Auth::get('id'));

      \Messages::modal('Connected to the grid', "You've connected to the grid " . $updateData['daily_login_count'] . " times in a row!");
    }

    \Messages::voice('accessgranted');
  }
}
