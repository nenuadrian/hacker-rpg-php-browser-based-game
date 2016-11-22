<?php


class Controller_Affiliate extends Controller
{
	public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index()
	{
		$tVars = array();

		
		return View::forge('affiliate/affiliate', $tVars);
	}

}