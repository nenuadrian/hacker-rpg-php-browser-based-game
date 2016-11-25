<?php
use \Model\Train;
use \Model\Task;
use \Model\Missions;
use \Model\DBMock;


class Controller_Train extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }


	public function action_index()
    {
    	if (Task::get_one(Auth::get('id'), 2)) Response::redirect(Uri::create('train/train'));

    	$tVars = array();

    	$train = Train::process(Auth::get('train'));

    	if (Input::post()) {
    		$data = array();
    		$data['train_type'] = intval(Input::post('train_type'));
            $train = $train[$data['train_type']];

            if ($data['train_type'] == 1) {
            } elseif ($data['train_type'] == 2) {
                $mission = \DB::select()->from('quest')->where('quest_group_id', 3)->where('live', 1)->where('level', '<=', $train['level'])->order_by(DB::expr('RAND()'))->limit(1)->execute()->as_array()[0];

                $data['mission'] = Missions::prepare_data($mission['quest_id']);

            } elseif ($data['train_type'] == 3) {

                $db = DBMock::get_fresh_db(Auth::get('id'), 'train');

               $sql = DB::select()->from('training')->where('type', 3)->where('min_level', '<=', $train['level'])->where('max_level', '>=', $train['level'])
                    ->order_by(DB::expr('RAND()'))->limit(1)->execute()->as_array()[0];

               $sql_init = $sql['init_script']. "PRAGMA max_page_count = 20; PRAGMA page_size = 512;";

                DBMock::run_sql($db, $sql_init);

                $db->close();

                $completion_conditions = $sql['completion_conditions'];
                $completion_conditions = array_filter(explode(";", $completion_conditions));
                foreach($completion_conditions as &$cc)
                    $cc = explode('|', $cc);

                $data['completion_conditions'] = $completion_conditions;

                $data['training_id'] = $sql['training_id'];
            }
    		Task::create(Auth::get('id'), 2, 1000, $data);
             Response::redirect(Uri::create('train/train'));
    	}

    	$tVars['train'] = $train;
        return View::forge('train/train', $tVars);
    }

    public function action_train() {
    	$tVars = array();
    	$task = Task::get_one(Auth::get('id'), 2);
    	if (!$task) Response::redirect(Uri::create('train'));

        if ($task['data']['train_type'] == 1) {
    	} elseif ($task['data']['train_type'] == 2) {

            if (isset($task['data']['mission']['completed'])) {

               /* $task['complete'] = time();
                $task['complete_status'] = 1;
                Task::save($task);
                Response::redirect(Uri::create('quests'));*/
            }
            return Missions::do_interface($task);
        } elseif ($task['data']['train_type'] == 3) {
            $training = DB::select()->from('training')->where('training_id', $task['data']['training_id'])->execute()->as_array()[0];

            if (Input::post('query')) {
                $db = DBMock::get_db(Auth::get('id'), 'train');
                $query = Input::post('query');
                if (DBMock::allowed($query)) {
                    $output = DBMock::query($db, $query);
                    $tVars['output'] = $output;
                    //$ret;
                    // verify if conditions are met
                    $done = true;
                    foreach ($task['data']['completion_conditions'] as $cc) {
                        if ($db->querySingle($cc[0]) != $cc[1]) {
                            $done = false; break;
                        }
                    }

                    if ($done) {
                      die();
                    }

                } else $tVars['output'] = "The Cardinal Query Language of this instance accepts only SELECT, INSERT and UPDATE commands.";


                $db->close();
            }
        }
        $tVars['task'] = $task;
        $tVars['instructions'] = $training['instructions'];
    	return View::forge('train/train_' . $task['data']['train_type'], $tVars);
    }
}
