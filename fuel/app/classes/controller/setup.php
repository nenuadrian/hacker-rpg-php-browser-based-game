<?php

class Controller_Setup extends Controller {

	public function action_index()  {
		if (File::exists(APPPATH . '/config/db.php')) {
			die('Must manually delete config.db.php');
		} 

		$tVars = array();
		if (Input::post()) {
			if (File::exists(APPPATH . '/config/db.php')) {
				File::delete(APPPATH . '/config/db.php');
			}

			File::copy(APPPATH . '/config/db.php.template', APPPATH . '/config/db.php');
			$configs = File::read(APPPATH . '/config/db.php', true);
			foreach(Input::post() as $key => $value) {
				$configs = str_replace($key, $value, $configs);
			}
			File::update(APPPATH . '/config', 'db.php', $configs);
			File::create(APPPATH . '/config', 'check.tmp', 'if this file exists, the DB can be populated');

			Response::redirect(Uri::create('setup/populate/' . Input::post('DATABASE') . '/' . Input::post('ADMIN_USER'). '/' . Input::post('ADMIN_PASS'). '/' . base64_encode(Input::post('ADMIN_EMAIL'))));
		}
		return View::forge('setup/setup', $tVars);
  }

  public function action_populate($db, $user, $pass, $email)  {
	if (!File::exists(APPPATH . '/config/check.tmp')) {
		die('Invalid setup please restart');
	} 
	$email = base64_decode($email);

	File::delete(APPPATH . '/config/check.tmp');

	$db = File::read(APPPATH . '/db.sql', true);

	$db = explode('-- --------------------------------------------------------', $db);

	foreach ($db as $sql) {
		DB::query($sql)->execute();
	}


	$id = Hacker::create($user, $pass, $email);
	Hacker::force_login($id);
	hacker::update(['group' => 3]);

	Response::redirect(Uri::create(Uri::base()));
  }


}
