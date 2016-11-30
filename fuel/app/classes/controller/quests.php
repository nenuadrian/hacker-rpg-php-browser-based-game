<?php
use \Model\Quests;
use \Model\Missions;
use \Model\Task;
use \Model\Rewards;

class Controller_Quests extends Controller {
    public function __construct() { if (!Auth::check()) Response::redirect(Uri::base()); }

	public function action_index() {
        if (Task::get_one(Auth::get('id'), 1)) Response::redirect(Uri::create('quests/interface'));

        $tVars = array();
        $groups = Quests::groups();
        $tVars['groups'] = $groups;
        return Response::forge(View::forge('quests/quests', $tVars))->set_header('Access-Control-Allow-Origin', '*');
    }

    public function action_group($group) {
        if (Task::get_one(Auth::get('id'), 1)) Response::redirect(Uri::create('quests/interface'));
        $tVars = array();

        $quests = Quests::of($group);

        $tVars['quests'] = $quests;
        return Response::forge(View::forge('quests/quests_group', $tVars))->set_header('Access-Control-Allow-Origin', '*');
    }


    public function action_play($mission) {
        if (Task::get_one(Auth::get('id'), 1)) Response::redirect(Uri::create('quests/interface'));
        $data = array('mission' => Missions::prepare_data($mission));
        Task::create(Auth::get('id'), 1, 300, $data, $mission);
        Response::redirect(Uri::create('quests/interface'));
    }

    public function action_interface() {

        $task = Task::get_one(Auth::get('id'), 1);
        if (!$task) Response::redirect(Uri::create('quests'));

        if (isset($task['data']['mission']['completed'])) {
            Quests::record_completion($task['user_id'], $task['data_id'], $task['task_duration'] - $task['remaining']);

            $task['complete'] = time();
            $task['complete_status'] = 1;

            $reward = array(
              'experience' => 10,
              'money' => 10,
              'skill_points' => 1
            );
            Rewards::give(Auth::get('id'), $reward, 'Mission');

            Task::save($task);
            Response::redirect(Uri::create('quests'));
        }
        return Missions::do_interface($task);
    }
}
