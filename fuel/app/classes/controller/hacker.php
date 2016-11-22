<?php
use \Model\Achievements;
use \Model\Hacker;

class Controller_Hacker extends Controller
{
	public function action_access($username) 
    {
    	$tVars = array();

    	$hacker = Hacker::get_by_username($username);
    	$hacker['achievements'] = Achievements::process($hacker['achievements']);
    	$tVars['hacker'] = $hacker;
        return View::forge('hacker/hacker', $tVars);
    }
}
