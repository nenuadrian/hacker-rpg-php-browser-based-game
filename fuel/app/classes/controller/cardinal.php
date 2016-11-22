<?php
use \Model\Missions;
use \Model\Task;

class Controller_Cardinal extends Controller
{
    

    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
        if (Auth::get('group') != 2) Response::redirect(Uri::base());
    }

    public function action_tutorial() {
        $tVars = array();

        if (Input::post('update')) {
            DB::update('tutorial_step')->set(Input::post())->where('step_id', Input::post('update'))->execute();
            Response::redirect(Uri::current());
        }

        $steps = DB::select()->from('tutorial_step')->order_by('step_id', 'asc')->execute()->as_array(); 

        $tVars['steps'] = $steps;
        return View::forge('cardinal/cardinal_tutorial', $tVars);
    }

	public function action_index() 
    {
        $tVars = array();

        return View::forge('cardinal/cardinal', $tVars);
    }

    public function action_quest_play($mission) {
        if (Task::get_one(Auth::get('id'), 100)) Response::redirect(Uri::create('cardinal/interface'));
        $data = array('mission' => Missions::prepare_data($mission));
        Task::create(Auth::get('id'), 100, 30000, $data, $mission);
        Response::redirect(Uri::create('cardinal/interface'));
    }

    public function action_interface() {
        $task = Task::get_one(Auth::get('id'), 100);
        if (!$task) Response::redirect(Uri::create('cardinal'));

        if (isset($task['data']['mission']['completed'])) {
            $task['complete'] = time();
            $task['complete_status'] = 1;
            Task::save($task);
            Response::redirect(Uri::current());
        }
        return Missions::interface($task);
    }


    public function action_quest($quest_id) {
        $tVars = array();
        $quest = DB::select()->from('quest')->where('quest_id', $quest_id)->execute()->as_array()[0];

        if (Input::post()) {
            DB::update('quest')->set(Input::post())->where('quest_id', $quest_id)->execute();
            Response::redirect(Uri::current());
        }
        $quests = DB::select('quest_id', 'name')->from('quest')->where('quest_id', '!=', $quest_id)->execute()->as_array();
        $services = DB::select('qss.*', 'qs.hostname')->from(array('quest_server_service', 'qss'))->join(array('quest_server', 'qs'), 'left outer')->on('qs.quest_server_id', '=', 'qss.quest_server_id')->where('qss.quest_id', $quest_id)->execute()->as_array();

        $tVars['quest'] = $quest;
        $tVars['services'] = $services;
        $tVars['quests'] = $quests;
        return View::forge('cardinal/mission/cardinal_quest', $tVars);
    } 

    public function action_quest_servers($quest_id) {
        $tVars = array();
        $quest = DB::select()->from('quest')->where('quest_id', $quest_id)->execute()->as_array()[0];
        if (Input::post('add_server')) {
            Missions::add_server($quest['quest_id']);
            Response::redirect(Uri::current());
        }

        if (Input::post('quest_server_id')) {
            if (Input::post('add_service')) { 
                Missions::add_service(Input::post('quest_server_id'), $quest['quest_id']);
            } elseif (Input::post('delete')) {
                Missions::delete_server(Input::post('quest_server_id'), $quest['quest_id']);
            } else {
                Missions::update_server(Input::post('quest_server_id'), $quest['quest_id'], Input::post());
            }
            Response::redirect(Uri::current() . '?quest_server_id=' . Input::post('quest_server_id'));
        }
        if (Input::post('service_id')) {
             if (Input::post('add_entity')) { 
                Missions::add_entity(Input::post('service_id'), $quest['quest_id']);
            } elseif (Input::post('delete')) {
                Missions::delete_service(Input::post('service_id'), $quest['quest_id']);
            } else {
                Missions::update_service(Input::post('service_id'), $quest['quest_id'], Input::post());
            }
            Response::redirect(Uri::current() . '?service_id=' . Input::post('service_id'));
        }

        if (Input::post('entity_id')) {
            if (Input::post('add_entity')) {
                Missions::add_entity(Input::post('service_id'), $quest['quest_id'], Input::post('entity_id')); 
            } elseif (Input::post('delete')) {
                Missions::delete_entity(Input::post('entity_id'), $quest['quest_id']);
            } else {
                Missions::update_entity(Input::post('entity_id'), $quest['quest_id'], Input::post());
            }
            Response::redirect(Uri::current() . '?entity_id=' . Input::post('entity_id'));
        }

        $servers = DB::select()->from('quest_server')->where('quest_id', $quest_id)->execute()->as_array('quest_server_id');
        $services = DB::select()->from('quest_server_service')->where('quest_id', $quest_id)->order_by('port', 'asc')->execute()->as_array('service_id');
        $entities = DB::select()->from('quest_service_entity')->where('quest_id', $quest_id)->order_by('title', 'asc')->execute()->as_array('entity_id');
        $objectives = DB::select()->from('quest_objective')->where('quest_id', $quest_id)->where('parent_objective_id', 'IS', NULL)->order_by('objective_order', 'asc')->execute()->as_array('objective_id');

        $tVars['quest'] = $quest;
        $tVars['objectives'] = $objectives;
        $tVars['services'] = $services;
        $tVars['entities'] = $entities;
        $tVars['servers'] = $servers;
        return View::forge('cardinal/mission/cardinal_quest_servers', $tVars);
    }

    public function action_quest_objectives($quest_id) {
        $tVars = array();
        $quest = DB::select()->from('quest')->where('quest_id', $quest_id)->execute()->as_array()[0];

        if (Input::post('add_objective')) {
            DB::insert('quest_objective')->set(array(
                'quest_id' => $quest['quest_id'], 
                'objective_order' => DB::query('SELECT IFNULL(MAX(objective_order),-1) + 1 oo from quest_objective where quest_id = ' . $quest['quest_id'])->execute()->as_array()[0]['oo']
            ))->execute();
            Response::redirect(Uri::current());
        }

        if (Input::post('add_side')) {
            DB::insert('quest_objective')->set(array('quest_id' => $quest['quest_id'], 'parent_objective_id' => Input::post('add_side')))->execute();
            Response::redirect(Uri::current() . '?objective_id=' . Input::post('add_side'));
        }

        if (Input::post('objective_id')) {
            $data = Input::post();
            if (Input::post('type')) {
                $data['data'] = implode(':', array_filter(array(Input::post('data_entity'), Input::post('data_service'))));
                if (isset($data['data_entity'])) unset($data['data_entity']);
                if (isset($data['data_service'])) unset($data['data_service']);
            }
            DB::update('quest_objective')->set($data)->where('objective_id', Input::post('objective_id'))->execute();
            Response::redirect(Uri::current() . '?objective_id=' . Input::post('objective_id'));
        }

        if (Input::post('delete')) {
            DB::delete('quest_objective')->where('objective_id', Input::post('delete'))->or_where('parent_objective_id', Input::post('delete'))->execute();
            Response::redirect(Uri::current());
        }

        $objectives = DB::select()->from('quest_objective')->where('quest_id', $quest_id)->order_by('objective_order', 'asc')->execute()->as_array('objective_id');
        $services = DB::select('qss.*', 'qs.hostname', 'qss.users')->from(array('quest_server_service', 'qss'))->join(array('quest_server', 'qs'),'left outer')->on('qs.quest_server_id', '=', 'qss.quest_server_id')->where('qss.quest_id', $quest_id)->execute()->as_array();
        
        $entities = DB::select('qse.*', 'qs.hostname', 'qss.port')->from(array('quest_service_entity', 'qse'))->join(array('quest_server_service', 'qss'), 'left outer')->on('qss.service_id', '=', 'qse.service_id')->join(array('quest_server', 'qs'))->on('qs.quest_server_id', '=', 'qss.quest_server_id')->where('qse.quest_id', $quest_id)->execute()->as_array();

        $tVars['quest'] = $quest;
        $tVars['objectives'] = $objectives;
        $tVars['services'] = $services;
        $tVars['entities'] = $entities;
        return View::forge('cardinal/mission/cardinal_quest_objectives', $tVars);
    } 

    public function action_missions() 
    {
        $tVars = array();

        if (Input::post('add_group')) {
            DB::insert('quest_group')->set(array('name' => 'New group'))->execute();
            Response::redirect(Uri::current());
        }

        if (Input::post('add_quest')) {
            DB::insert('quest')->set(array('name' => 'New quest', 'quest_group_id' => Input::post('add_quest')))->execute();
            Response::redirect(Uri::current());
        }

        if (Input::post('quest_group_id')) {
            DB::update('quest_group')->set(Input::post())->where('quest_group_id', Input::post('quest_group_id'))->execute();
            Response::redirect(Uri::current());
        }

        $quests = DB::select()->from('quest')->order_by('quest_group_order', 'asc')->execute()->as_array();
        $groups = DB::select()->from('quest_group')->order_by('type', 'asc')->order_by('group_order', 'asc')->execute()->as_array();

        $tVars['quests'] = $quests;
        $tVars['groups'] = $groups;
        return View::forge('cardinal/mission/cardinal_quests', $tVars);
    }
}
