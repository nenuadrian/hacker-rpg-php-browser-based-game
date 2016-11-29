<?php
use \Model\Knowledge;
use \Model\Task;

class Controller_Knowledge extends Controller {
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }

  public function action_index() {
        if (Task::get_one(Auth::get('id'), 4)) Response::redirect(Uri::create('knowledge/learning'));

    	$tVars = array();

    	$user_knowledge = Knowledge::process(Auth::get('knowledge'));

        $tVars['knowledge'] = Knowledge::knowledge();
        $tVars['user_knowledge'] = $user_knowledge;
        return View::forge('knowledge/knowledge', $tVars);
    }

    public function action_learning() {
        $task = Task::get_one(Auth::get('id'), 4);
        if (!$task) Response::redirect(Uri::create('knowledge'));
        $tVars = array();
        $tVars['task'] = $task;
        return View::forge('knowledge/knowledge_learning', $tVars);
    }

    public function action_learn($k_id) {
        if (Task::get_one(Auth::get('id'), 4)) Response::redirect(Uri::create('knowledge/learning'));
    	$knowledge = Knowledge::process(Auth::get('knowledge'));

        $data['knowledge'] = $k_id;
        Task::create(Auth::get('id'), 4, 300, $data);
        Messages::voice('ability_in_progress');
    	Response::redirect(Uri::create('knowledge'));
    }
}
