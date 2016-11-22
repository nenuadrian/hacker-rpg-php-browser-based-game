<?php

class Controller_Premium extends Controller
{
	public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index() 
    {
        return View::forge('premium/premium');
    }

}
