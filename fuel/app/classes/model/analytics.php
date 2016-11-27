<?php

namespace Model;

class Analytics extends \Model {
  public static function record($event, $data, $user_id = null) {
    try {
      $user_id = $user_id ? (\Auth::check() ? \Auth::get('id') : null) : null;
      \DB::insert('analytics')->set(array('event' => $event, 'data' => json_encode($data), 'user_id' => $user_id))->execute();
    } catch (Exception $ex) {}
  }
}
