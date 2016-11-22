<?php

class Controller_Welcome extends Controller
{
	public function action_index() {
		if (\Auth::check()) \Response::redirect('dashboard');

	    // was the login form posted?
	    if (\Input::method() == 'POST')
	    {
	        // check the credentials.
	        if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
	        {
	            // did the user want to be remembered?
	            if (\Input::param('remember', false))
	            {
	                // create the remember-me cookie
	                \Auth::remember_me();
	            }
	            else
	            {
	                // delete the remember-me cookie if present
	                \Auth::dont_remember_me();
	            }

	            // logged in, go back to the page the user came from, or the
	            // application dashboard if no previous page can be detected
	            \Messages::modal('Welcome', 'test');
	            \Messages::voice('accessgranted');
	            \Response::redirect_back('dashboard');
	        }
	        else
	        {
	            // login failed, show an error message
	            \Messages::voice('accessdenied');
	            \Messages::error("Access Denied");
	        }
	    }

		return Response::forge(View::forge('welcome/index'));
	}

	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
