<?php
use \Model\Train;
use \Model\Task;
use \Model\Missions;
use \Model\DBMock;
use \Model\Rewards;

class Controller_Train extends Controller {
  public function __construct() { if (!Auth::check()) Response::redirect(Uri::base()); }

	public function action_index()
    {
    	if (Task::get_one(Auth::get('id'), 2)) Response::redirect(Uri::create('train/train'));

    	$tVars = array();

    	$train = Train::process(Auth::get('train'));

    	if (Input::post()) {
    		$data = array();
    		$data['train_type'] = intval(Input::post('train_type'));
        $train = $train[$data['train_type']];
        $train_type = Train::types()[$data['train_type']];

        $mission = \DB::select()->from('quest')->where('quest_group_id', $train_type['quest_group_id'])->where('live', 1)->where('level', '<=', $train['level'])->order_by(DB::expr('RAND()'))->limit(1)->execute()->as_array();
        if (count($mission)) {
          $mission = $mission[0];
          $data['mission'] = Missions::prepare_data($mission['quest_id']);
  		    Task::create(Auth::get('id'), 2, 1000, $data);
          Response::redirect(Uri::create('train/train'));
        } else Messages::error("No sessions available for you");
        Response::redirect(Uri::current());
    	}

    	$tVars['train'] = $train;
      return View::forge('train/train', $tVars);
    }

    public function action_train() {
    	$tVars = array();
    	$task = Task::get_one(Auth::get('id'), 2);
    	if (!$task) Response::redirect(Uri::create('train'));

      if (isset($task['data']['mission']['completed'])) {


        $reward = array(
          'experience' => 10,
          'money' => 10,
          'skill_points' => 1
        );
        Rewards::give(Auth::get('id'), $reward, 'Train');

          $task['complete'] = time();
          $task['complete_status'] = 1;
          Task::save($task);
          Response::redirect(Uri::create('train'));
      }
      return Missions::do_interface($task);
    }
}
