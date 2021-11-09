<?php

class Controller_Welcome extends Controller {
	public function __construct() {
		if (!File::exists(APPPATH . '/config/db.php')) {
			Response::redirect(Uri::create('setup'));
		} 
	}

	public function action_index() {
		if (Hacker::check()) Response::redirect(Uri::create('dashboard'));

		if (Input::post('connect')) {
			if (Hacker::login(Input::post('username'), Input::post('password'))) {
				Response::redirect_back('dashboard');
			} else {
				Messages::voice('accessdenied');
				Messages::error("Access Denied");
			}
		}

		if (Input::post('register')) {
			try {
					$id = Hacker::create(Input::post('username'), Input::post('password'), Input::post('email'));
					Hacker::force_login($id);
					if (Config::get('email_confirmation_enabled')) {
						\Model\Emails::send(Input::post('email'), Input::post('username'), 'welcome', ['USERNAME' => Input::post('username')]);
						$this->send_confirmation_email($id, Input::post('email'), Input::post('username'));
					} 

					Response::redirect(Uri::create('pages/view/story'));
				} catch (Exception $e) {
					if ($e->getMessage() == 'email_used') {
						Messages::error("We've already got a citizen with this email address.");
					} elseif ($e->getMessage() == 'email_invalid') {
						Messages::error("Your e-mail smells funny. A typo?");
					} elseif ($e->getMessage() == 'username_invalid') {
						Messages::error("Your nickname should consist only of letters and numbers.");
					} elseif ($e->getMessage() == 'username_used') {
						Messages::error("We've already got a citizen with this name.");
					} elseif ($e->getMessage() == 'password_invalid') {
						Messages::error("Password should be 5 - 30 characters long.");
					} else {
						Messages::error($e->getMessage());
					}
				}
		}

		return View::forge('welcome/index');
	}

	public function action_change($hash) {
		$user = DB::select()->from('user')->where('password_reset_hash', $hash)->execute()->as_array();
		if (Hacker::check() || !$user) Response::redirect(Uri::base());
		$user = $user[0];
		Hacker::force_login($user['user_id']);
		Response::redirect(Uri::create('dna/index/' . $hash));
	}

	public function action_forgot() {
		if (!filter_var(Input::post('email'), FILTER_VALIDATE_EMAIL)) {
			Messages::error('Our system did not like that email');
		} else {
			$user = Hacker::find_by_email(Input::post('email'));
			if ($user) {
				$reset_hash = md5($user['user_id'] . '23%@#%FfsdfD2sadfg' . time() . rand(1, 1000));
				$reset_url = Uri::create('welcome/change/' . $reset_hash);

				Hacker::update(array('password_reset_hash' => $reset_hash, 'password_reset_last_request' => DB::expr('NOW()')), $user['user_id']);

				\Model\Emails::send(Input::post('email'), $user['username'], 'reset', ['USERNAME' => $user['username'], 'RESET_URL' => $reset_url]);
			}

			Messages::success("If there's an account using this e-mail in our database, we've sent a reset link on its way!");
			Response::redirect(Uri::base());
		}

		return View::forge('welcome/forgot');
	}

	public function action_confirm($hash) {
			$user = DB::select()->from('user')->where('email_hash', $hash)->execute()->as_array();
			if (!$user) Response::redirect(Uri::base());
			$user = $user[0];
			Messages::success('Email has been confirmed and your privileges have been updated succesfully!');
			Hacker::update(array('email_confirmed' => 1), $user['user_id']);
			Response::redirect(Uri::base());
	}

	public function action_resend() {
		if (Hacker::get('email_last_confirm_req')) {
			$last = strtotime(Hacker::get('email_last_confirm_req'));
			if (time() - $last < 30 * 60) {
				Messages::error('You can request a new confirmation email only once every 30 minutes.');
				return Response::redirect(Uri::base());
			}
		}
		$this->send_confirmation_email(Hacker::id(), Hacker::email(), Hacker::username());
		Messages::success("We've put our minions to work. Make sure you check your Spam too! Previous confirmation links no longer work!");
		Response::redirect(Uri::base());
	}

	private function send_confirmation_email($user_id, $target, $username) {
		$confirm_hash = md5($user_id . $username . '23%@#%FD2sadfg' . time() . rand(1, 1000));
		$confirm_url = Uri::create('welcome/confirm/' . $confirm_hash);
		Hacker::update(array('email_last_confirm_req' => DB::expr('NOW()'), 'email_hash' => $confirm_hash), $user_id);

		\Model\Emails::send($target, $username, 'confirm', ['USERNAME' => $username, 'CONFIRM_URL' => $confirm_url]);
	}

	public function action_logout() {
		if (!Hacker::check()) Response::redirect(Uri::base());
		Hacker::logout();

		if (Hacker::get('emergency_logout')) {
				return Response::redirect(Hacker::get('emergency_logout'));
		}
		Response::redirect(Uri::base());
	}

	public function action_404() {
		return View::forge('welcome/404');
	}
}
