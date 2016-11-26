<?php
use \Model\Achievements;
use \Model\Hacker;

class Controller_Hackdown extends Controller {
	public function action_index() {
    	$tVars = array();
      return View::forge('hackdown/hackdown', $tVars);
    }
}
