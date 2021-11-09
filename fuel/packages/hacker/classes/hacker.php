<?php
namespace Hacker;

class Hacker {
  private static $hacker = null;
  private static $groups = array(
    2 => array(
      'cardinal' => true
    ),
    3 => array(
      'cardinal_dashboard' => true,
      'manage_missions' => true,
    ),
  );

  public static function can($perm) {
      if (!static::check()) return false;
      $group = isset(static::$groups[static::group()]) ? static::$groups[static::group()] : array();
      return isset($group['cardinal']) || isset($group[$perm]);
  }

  public static function create($username, $password, $email) {
    if (!static::valid_username($username)) {
      throw new \Exception('username_invalid');
    }
    if (static::find_by_username($username)) {
      throw new \Exception('username_used');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new \Exception('email_invalid');
    }
    if (static::find_by_email($email)) {
      throw new \Exception('email_used');
    }
    if (!static::valid_password($password)) {
      throw new \Exception('password_invalid');
    }
    \Model\Analytics::record('register', array('headers' => \Input::headers()));
    \DB::insert('user')->set(array('username' => $username, 'password' => static::encrypt_password($password), 'email' => $email,
      'email_confirmed' => \Config::get('email_confirmation_enabled') ? 0 : 1))->execute();
    $id = \DB::select('user_id')->from('user')->where('username', $username)->execute()->as_array()[0]['user_id'];
    return $id;
  }

  public static function valid_password($password) {
    return strlen($password) <= 30 && strlen($password) >= 5;
  }

  public static function valid_username($username) {
    return strlen($username) <= 30 && ctype_alnum($username);
  }

  public static function init() {
    if (\Session::get('_user_id')) {
      $hacker = \DB::select()->from('user')->where('user_id', \Session::get('_user_id'))->limit(1)->execute()->as_array();
      if (!$hacker) {
        \Session::destroy(); return;
      }
      $hacker = $hacker[0];

      static::$hacker = $hacker;

      if (\Session::get('last_active_update', 0) + 10 <= time()) {
				\DB::update('user')->set(array('last_active' => \DB::expr('NOW()')))->where('user_id', static::id())->execute();
				\Session::set('last_active_update', time());
			}

    }
  }

  public static function compare_passwords($password, $encrypt_password) {
    return static::encrypt_password($password) == $encrypt_password;
  }

  public static function encrypt_password($password) {
    return base64_encode(hash_pbkdf2('sha256', $password, \Config::get('salt'), \Config::get('iterations', 10000), 32, true));
  }

  public static function force_login($user_id) {
    \Session::set('_user_id', $user_id);
    static::init();
    static::process_login();
  }

  public static function login($hackername, $password) {
    $password = static::encrypt_password(trim($password));
    $login = \DB::select('user_id')->from('user')->where('username', $hackername)->where('password', $password)->limit(1)->execute()->as_array();
    if (!$login) return false;
    $login = $login[0];
    \Session::set('_user_id', $login['user_id']);
    static::init();
    static::process_login();
    return $login['user_id'];
  }

  public static function check($redirect = false) {
    if (!($result = (static::$hacker != null)) && $redirect) \Response::redirect($redirect);
    return $result;
  }

  public static function get($field) { return static::$hacker ? (isset(static::$hacker[$field]) ? static::$hacker[$field] : null) : null; }
  public static function id() { return static::get('user_id'); }
  public static function group() { return static::get('group'); }
  public static function username() { return static::get('username'); }
  public static function email() { return static::get('email'); }
  public static function level() { return static::get('level'); }
  public static function email_confirmed() { return static::get('email_confirmed'); }

  public static function update($data, $hacker_id = false) {
      if (!$hacker_id) $hacker_id = static::id();
      \DB::update('user')->set($data)->where('user_id', $hacker_id)->limit(1)->execute();
  }

  public static function experience($level) { return $level * 10; }

  public static function find_by_username($username) {
      $hacker = \DB::select()->from('user')->where('username', $username)->execute();
      return isset($hacker[0]) ? $hacker[0] : false;
  }

  public static function find_by_email($username) {
      $hacker = \DB::select()->from('user')->where('email', $username)->execute();
      return isset($hacker[0]) ? $hacker[0] : false;
  }

  public static function process_login() {
    // daily login
    $today = \Date::forge(time())->format("%Y-%m-%d");
    $yesterday = \Date::forge(strtotime('-1 day', time()))->format("%Y-%m-%d");

    if (static::get('daily_login_last')) {
      $login_last = \Date::forge(strtotime(static::get('daily_login_last')))->format("%Y-%m-%d");
    } else {
      $login_last = \Date::forge(0)->format("%Y-%m-%d");
    }

    if ($login_last != $today) {
      $updateData = array(
        'daily_login_last' => $today,
        'daily_login_count' => 1
      );

      if ($updateData['daily_login_count'] > 1) {
        if ($login_last == $yesterday) {
          $updateData['daily_login_count'] = static::get('daily_login_count') + 1;
          if ($updateData['daily_login_count'] == 5) \Model\Rewards::give(static::id(), array('achievements' => array(1)), "5th time's the charm");
          if ($updateData['daily_login_count'] == 15) \Model\Rewards::give(static::id(), array('achievements' => array(2)), "15th time's the charm");
          if ($updateData['daily_login_count'] == 30) \Model\Rewards::give(static::id(), array('achievements' => array(3)), "30th time's the charm");
          if ($updateData['daily_login_count'] == 60) \Model\Rewards::give(static::id(), array('achievements' => array(4)), "60th time's the charm");
        }

        \Model\Rewards::give(static::id(), array('experience' => 3 * $updateData['daily_login_count'] ), 'Stacked ' . $updateData['daily_login_count'] . ' days');
        \Messages::modal('Connected to the grid', "<p>You've connected to the grid " . $updateData['daily_login_count'] . " days in a row!</p><p>The more days you stack, the higher the rewards get!</p>");
      }

      Hacker::update($updateData);
    }

    \Messages::voice('accessgranted');
  }

  public static function logout() {
    \Session::destroy();
  }

  public static function unread_conversations() {
    return \DB::select(\DB::expr('count(*) as count'))->where('parent_conversation_id', 'IS', NULL)->from('conversation')->where('unseen', 1)->where('last_replier_id', '!=', static::id())->where(function($conv) {
         return $conv->where('user_1_id', static::id())->or_where('user_2_id', static::id());
     })->execute()->as_array()[0]['count'];
  }

  public static function unclaimed_rewards() {
    return \DB::select(\DB::expr('count(*) as count'))->from('reward')->where('user_id', static::id())->where('claimed', 'IS', NULL)->execute()->as_array()[0]['count'];
  }
}
