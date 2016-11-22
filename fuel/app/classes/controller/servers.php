<?php
use \Model\Servers;
use \Model\Hacker;
use \Model\Task;
use \Model\Apps;
use \Model\Skills;

class Controller_Servers extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index() 
    {
        $tVars = array();

        $servers = Servers::of(Auth::get('id'));

        if (Input::post('main')) {
            foreach($servers as $s) {
                if ($s['server_id'] == Input::post('main')) {
                    Hacker::save(array('main_server' => $s['server_id']));
                    Response::redirect(Uri::current());
                }
            }
        }
        $tVars['servers'] = $servers;
        return View::forge('servers/servers', $tVars);
    }

    public function action_server($server) 
    {
        $tVars = array();

        $server = Servers::get($server, Auth::get('id'));

        if (Input::post('name')) {
            Servers::save(array('server_id' => $server['server_id'], 'hostname' => Input::post('name')));
            Response::redirect(Uri::current());
        }

        $apps = Apps::get($server['server_id']);

        $server_tasks = Task::get_for_server($server['server_id']);
        if (Input::post("app_action")) {
            foreach($apps as &$app) if ($app['server_app_id'] == Input::post("app_action")) break;
            $skills_influence = Skills::influence_total(\Auth::get('skills')); ;
            if (Input::post('action') == 'plant') {
                $data = array('server_app_id' => $app['server_app_id'], 'target' => Input::post('target'), 'app' => array('type' => $app['plants']));
                Task::create_for_server(Auth::get('id'), $server['server_id'], 6, 15, $data);
            }
            else if (Input::post('action') == 'steal') {
                $data = array('server_app_id' => $app['server_app_id'], 'target' => Input::post('target'));
                Task::create_for_server(Auth::get('id'), $server['server_id'], 5, 15, $data);
            }
            else if (Input::post('action') == 'scan') {
                $data = array('server_app_id' => $app['server_app_id']);
                Task::create_for_server(Auth::get('id'), $server['server_id'], 3, 15, $data);
            }
                
            if (isset($app['user_run'])) {         
                if (Input::post('action') == 'kill') {
                    Servers::kill_app($server, $app);
                }

                if (Input::post('action') == 'start') {
                    if (Servers::can_run_app($server, $app)['can']) {
                        Servers::run_app($server, $app);
                    }
                }
            }
            Response::redirect(Uri::current());
        }

        $tVars['server'] = $server;
        $tVars['apps'] = $apps;
        $tVars['server_tasks'] = $server_tasks;
        return View::forge('servers/server', $tVars);
    }

    public function action_new() {
        if (Input::post('create')) {
            $components = array('ram', 'cpu', 'ssd');
            $total = 0;
            $server_components = array();
            foreach($components as $c) {
                if (Input::post($c) === null) Response::redirect(Uri::current());
                $comp = Config::get('hardware')[$c][Input::post($c)];
                $total += $comp['price'];
                $server_components[$c] = $comp;
            }

            if ($total <= Auth::get('money')) {
                Servers::create(Auth::get('id'), $server_components);
                Response::redirect(Uri::create('servers'));
            }
        }
        $tVars = array();

        return View::forge('servers/server_create', $tVars);
    }
}
