<?php
use \Model\Quests;
use \Model\Missions;
use \Model\Task;

class Controller_Demo extends Controller {
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }

	  public function action_index() {
        if (Task::get_one(Auth::get('id'), 13)) Response::redirect(Uri::create('demo/interface'));
        $tVars = array();
        return View::forge('demo/demo_index', $tVars);
    }

    public function action_play($mission) {
        if (Task::get_one(Auth::get('id'), 13)) Response::redirect(Uri::create('demo/interface'));
        $data = array('mission' => Missions::prepare_data($mission));
        Task::create(Auth::get('id'), 13, 300, $data, $mission);
        Response::redirect(Uri::create('quests/interface'));
    }

    public function action_interface() {
        $task = Task::get_one(Auth::get('id'), 13);
        if (!$task) Response::redirect(Uri::create('demo'));

        if (isset($task['data']['mission']['completed'])) {
            Quests::record_completion($task['user_id'], $task['data_id'], $task['task_duration'] - $task['remaining']);

            $task['complete'] = time();
            $task['complete_status'] = 1;
            Task::save($task);
            Response::redirect(Uri::create('demo'));
        }
        return Missions::interface($task);
    }
}
