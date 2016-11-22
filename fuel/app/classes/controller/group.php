<?php
use \Model\Group;

class Controller_Group extends Controller
{
	public function action_index() 
    {
        if (Auth::get('hacker_group_id')) Response::redirect(Uri::create('group/access/' . Auth::get('hacker_group_id')));
    	$tVars = array();

        return View::forge('group/group_index', $tVars);
    }

    public function action_access($g_id) {
    	$group = Group::get($g_id);

        $tVars = array();

    	$tVars['group'] = $group;
        return View::forge('group/group', $tVars);
    }

    public function action_create() {
        $tVars = array();

        if (Input::post()) {
            $g_id = Group::create(Auth::get('id'), Input::post('name'));
            if ($g_id) {
                Response::redirect(Uri::create('group/access/' . $g_id));
            }
        }

        return View::forge('group/group_create', $tVars);
    }
}
