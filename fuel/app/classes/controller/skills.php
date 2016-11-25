<?php
use \Model\Hacker;
use \Model\Skills;

class Controller_Skills extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }

	public function action_index()
    {
    	$tVars = array();

    	$skills = Skills::process(Auth::get('skills'));

    	if (Auth::get('skill_points') && Input::post('add_points') && intval(Input::post('points')) <= Auth::get('skill_points')) {
    		$skill_id = intval(Input::post('add_points'));
        $points = intval(Input::post('points'));

    		Skills::add_experience($skills[$skill_id], $points);
    		Skills::save(Auth::get('id'), $skills);
    		Hacker::save(array('skill_points' => DB::expr('skill_points - ' . $points)));
    		Response::redirect(Uri::current());
    	}
    	$tVars['skills'] = $skills;
        return View::forge('skills/skills', $tVars);
    }
}
