<?php
use \Model\Authenticate;

class Controller_Welcome extends Controller {
	public function action_index() {
		if (\Auth::check()) \Response::redirect('dashboard');

    // was the login form posted?
    if (Input::post()) {
        // check the credentials.
        if (\Auth::instance()->login(\Input::param('username'), \Input::param('password'))) {
            \Auth::remember_me();

						Authenticate::process_login();
            
            \Response::redirect_back('dashboard');
        } else {
            // login failed, show an error message
            \Messages::voice('accessdenied');
            \Messages::error("Access Denied");
        }
    }

		return Response::forge(View::forge('welcome/index'));
	}

	public function action_404()
	{
		return View::forge('welcome/404');
	}
}
