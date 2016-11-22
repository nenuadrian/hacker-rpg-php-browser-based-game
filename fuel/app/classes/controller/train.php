<?php
use \Model\Train;
use \Model\Task;
use \Model\Missions;

class MyDB extends SQLite3
{
  function __construct($sql_file)
  {
     $this->open($sql_file);
  }
}

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
                $sql_path = APPPATH . 'tmp';
                $sql_filename = 'train_' . Auth::get('id') . '.db';
                $sql_file = $sql_path . '/' . $sql_filename;
                //File::delete($sql_file);
                if (!File::exists($sql_file))
                    File::create($sql_path, $sql_filename, '');
                else File::update($sql_path, $sql_filename, '');

                $data['sql_file'] = $sql_file;
                
                   $db = new MyDB($sql_file);

                   $sql = DB::select()->from('training')->where('type', 3)->where('min_level', '<=', $train['level'])->where('max_level', '>=', $train['level'])
                        ->order_by(DB::expr('RAND()'))->limit(1)->execute()->as_array()[0];

                   $sql_init = $sql['init_script']. "PRAGMA max_page_count = 20; PRAGMA page_size = 512;";

                $db->exec($sql_init);

                $db->close();
                $completion_conditions = $sql['completion_conditions'];
                $completion_conditions = array_filter(explode(";", $completion_conditions));
                foreach($completion_conditions as &$cc)
                    $cc = explode('|', $cc);

                $data['completion_conditions'] = $completion_conditions;
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
            return Missions::interface($task);
        } elseif ($task['data']['train_type'] == 3) {

            if (Input::post('query')) {
                $db = new MyDB($task['data']['sql_file']);
                try {
                    $query = trim(Input::post('query'));
                    $type = strtolower(substr($query, 0, 6));
                    if (in_array($type, array('select', 'insert', 'update'))) {
                        $ret = $db->query($query);

                        if ($type == 'select') {
                            $output = array();
                            while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
                                $output[] = $row;
                            }
                            $tVars['output'] = $output;
                        } elseif ($type == 'insert') {
                            $tVars['output'] = 'done';
                        } elseif ($type == 'update') {
                            $tVars['output'] = 'done';
                        }
                        
                        //$ret;
                        // verify if conditions are met
                        $done = true;
                        foreach ($task['data']['completion_conditions'] as $cc) {
                            if ($db->querySingle($cc[0]) != $cc[1]) {
                                //die();
                                $done = false; break;
                            }
                        }

                        if ($done) {
                            echo 'done';
                         //   die();
                        }

                    } else $tVars['output'] = "The Cardinal Query Language of this instance accepts only SELECT, INSERT and UPDATE commands.";
                   
                    /* 
                    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "ADDRESS = ". $row['ADDRESS'] ."\n";
      echo "SALARY =  ".$row['SALARY'] ."\n\n";
   }
   */
                } catch (Exception $ex) {
                    $tVars['output'] = $db->lastErrorMsg();
                }
                
                $db->close();
            }
        }
        $tVars['task'] = $task;
    	return View::forge('train/train_' . $task['data']['train_type'], $tVars);
    }
}
