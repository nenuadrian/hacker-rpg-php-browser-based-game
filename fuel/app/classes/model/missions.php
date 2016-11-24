<?php
use \Model\Task;
use \Model\Skills;
use \Model\Servers;

namespace Model;

class Missions extends \Model {
    public static $shortcode = false;
    private static $shortcode_mission = false;

    public static function commands() {
        return array(
            'crack_1' => array(
                'name' => 'SSH service cracking'
                ),
            'crack_2' => array(
                'name' => 'SSH service cracking'
                ),
            'crack_3' => array(
                'name' => 'SSH service cracking'
                ),
            'decrypt' => array(
                'name' => 'SSH service cracking'
                )
            );
    }

    public static function do_shortcode($mission, $text) {
        static::$shortcode_mission = $mission;
        if (!static::$shortcode) {
            $handlers = new \Thunder\Shortcode\HandlerContainer\HandlerContainer();
            $handlers->add('user', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                return sprintf('%s', \Auth::get($s->getParameter('attr')));
            });
            $handlers->add('substring', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                return sprintf('%s', substr($s->getContent(), $s->getParameter('start'), $s->getParameter('length') ? $s->getParameter('length') : 99999));
            });
            $handlers->add('username', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                return sprintf('%s', \Auth::get('username'));
            });
            /*$handlers->add('connected_username', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                return sprintf('%s', static::$shortcode_mission['connected']['username']);
            });*/
            $handlers->add('server', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                if ($s->getParameter('id'))
                    $server = static::$shortcode_mission['servers'][$s->getParameter('id')];
                elseif ($s->getParameter('hn'))
                    foreach(static::$shortcode_mission['servers'] as $server) if ($server['hostname'] == $s->getParameter('hn')) break;
                return sprintf('%s', $server[$s->getParameter('attr')]);
            });
            $handlers->add('ip', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
                if ($s->getParameter('id'))
                    $server = static::$shortcode_mission['servers'][$s->getParameter('id')];
                elseif ($s->getParameter('hn'))
                    foreach(static::$shortcode_mission['servers'] as $server) if ($server['hostname'] == $s->getParameter('hn')) break;
                return sprintf('%s', $server['ip']);
            });
            static::$shortcode = new \Thunder\Shortcode\Processor\Processor(new \Thunder\Shortcode\Parser\RegularParser(), $handlers);
        }
        return static::$shortcode->process($text);
    }

    public static function shortcode() {

        return $shortcode;
    }

    public static function interface_task(&$mission, &$tVars) {
        if (\Input::post('skip') && \Auth::get('group') == 2) {
            $mission['task']['task_duration'] = -1;
        }
        if (\Input::post('cancel')) {
            unset($mission['task']);
            return true;
        } else {
            $remaining = max(0, $mission['task']['task_start'] + $mission['task']['task_duration'] - time());
            if (!$remaining) {
                switch ($mission['task']['type']) {
                    case 'scan':
                        $srv_id = $mission['task']['data'];
                        foreach($mission['services'] as &$service) {
                            if (!isset($service['required_objective']) && $service['quest_server_id'] == $srv_id) {
                                $service['discovered'] = true;
                            }
                        }
                        break;
                     case 'ping':
                        $target = $mission['task']['data'];
                        foreach($mission['servers'] as &$server) {
                            if ($server['ip'] == $target) {
                                $server['discovered'] = true;
                                break;
                            }
                        }
                        break;
                }
                unset($mission['task']);
                return true;
            } else $tVars['task_remaining'] = $remaining;
        }
        return false;
    }

    private static function access_granted_to_service($users, $username, $password) {
        return !$users[$username]['security'] || ($users[$username]['password'] && $password == $users[$username]['password']);
    }

    public static function interface_server_actions(&$mission, &$tVars) {
        if (\Input::post('ping') && $target = \Input::post('ip')) {
            static::add_task($mission, 'ping', 60, $target, 'scan');
            return;
        }
        if ($service_id = intval(\Input::post('service_action'))) {
            $service = &$mission['services'][$service_id];
            $server = &$mission['servers'][$service['quest_server_id']];

            if (\Input::post('action') == 'crack') {
                $service['users'][\Input::post('username')]['security'] = false;
                //$service['security'] = false;
            }

            if (\Input::post('action') == 'connect') {
                if (static::access_granted_to_service($service['users'], \Input::post('username'), \Input::post('password'))) {

                    $mission['connected'] = array('service_id' => $service_id, 'username' => \Input::post('username'));
                    static::objective_check($task, $mission, 1, \Input::post('username') . ':' . $service_id);
                }
            }
        }

        if (\Input::post('server_action')) {
            $srv_id = intval(\Input::post('server_action'));
            $server = &$mission['servers'][$srv_id];

            if (\Input::post('action') == 'set_name') {
                $server['custom_name'] = \Input::post('custom_name');
            }
            if (\Input::post('action') == 'scan') {
                static::add_task($mission, 'scan', 30, $srv_id, 'scan');
            }
        }
    }

    public static function interface_entity(&$mission, &$tVars) {
        $entity_id = $mission['connected']['entity'];
        $entity = &$mission['entities'][$entity_id];
        if (\Input::post('action')) {

            if (\Input::post('action') == 'exit') {
                unset($mission['connected']['entity']);
                return;
            }
            if ($entity['security']) {
                if (\Input::post('action') == 'password') {
                    if ($entity['password'] && \Input::post('password') == $entity['password']) {
                        $entity['security'] = 0;
                    }
                }
                if (\Input::post('action') == 'crack') {
                    $entity['security'] = 0;
                }
            } else {
                if (!isset($entity['running'])) {
                    if (\Input::post('action') == 'execute') {
                        foreach($entity['required_running'] as $rr) {
                            if (!isset($mission['entities'][$rr[0]]['running']) || (isset($rr[1]) && $mission['entities'][$rr[0]]['service_id'] != $rr[1])) {
                                return;
                            }
                        }
                        $entity['running'] = true;
                        static::objective_check($task, $mission, 4, $entity_id);
                        static::objective_check($task, $mission, 7, $entity_id . ':' . $mission['connected']['username'] . ':' . $mission['connected']['service_id']);
                    }
                    if (\Input::post('action') == 'erase') {
                        static::objective_check($task, $mission, 3, $entity_id);
                        unset($mission['entities'][$entity_id]);
                        unset($mission['connected']['entity']);
                    }
                    if (\Input::post('action') == 'transfer') {
                        $transfer = explode(':', \Input::post('transfer'));
                        $service_id = $transfer[1];
                        $username = $transfer[0];
                        if ($mission['services'][$service_id]['type'] == 1) {
                            if (static::access_granted_to_service($mission['services'][$service_id]['users'], $username, \Input::post('password'))) {
                                $server_id = $mission['services'][$service_id]['quest_server_id'];
                                $entity['quest_server_id'] = $server_id;
                                $entity['service_id'] = $service_id;
                                $entity['owner'] = $username;
                                unset($mission['connected']['entity']);


                                static::objective_check($task, $mission, 6, $entity_id . ':' . $username . ':' . $service_id);
                            }
                        }
                    }
                } else {
                    if (\Input::post('action') == 'kill') {
                        unset($entity['running']);
                    }
                }
            }
        }

        $tVars['entity'] = $entity;
    }
    public static function interface_connected(&$mission, &$tVars) {
        $service = $mission['services'][$mission['connected']['service_id']];
        $server = $mission['servers'][$service['quest_server_id']];
        $tVars['service'] = $service;
        $tVars['server'] = $server;
        if (\Input::post('service_action') == 'disconnect') {
            unset($mission['connected']);
        }

        if (\Input::post('service_action') == 'bounce' && $service['type'] == 1) {
            $mission['bouncers'][] = $service['quest_server_id'];
            $mission['bouncers'] = array_unique($mission['bouncers']);
        }
        if (isset($mission['connected']['entity'])) {
            static::interface_entity($mission, $tVars);
        } else {
            if ($entity_id = \Input::post('entity_action')) {
                if (isset($mission['entities'][$entity_id]) && $mission['entities'][$entity_id]['service_id'] == $mission['connected']['service_id']) {
                    static::objective_check($task, $mission, 5, $entity_id);
                    $mission['connected']['entity'] = $entity_id;
                }
            }
        }

    }

    public static function interface($task) {
        $tVars = array();
        $mission = &$task['data']['mission'];
        $do_save = false;

        if (isset($mission['task'])) {
            $do_save = static::interface_task($mission, $tVars);
        } else {
            static::interface_server_actions($mission, $tVars);
            if (isset($mission['connected'])) {
                static::interface_connected($mission, $tVars);
            }
            if (\Input::post('remove_bounce')) {
                $mission['bouncers'] = array_diff($mission['bouncers'], [\Input::post('remove_bounce')]);
            }
        }

        if (\Input::post() || $do_save) {
            Task::save($task);
            \Response::redirect(\Uri::current());
        }

        if (!$mission["objective"]) {
            $mission['completed'] = true;
            Task::save($task);
            \Response::redirect(\Uri::current());
        }

        $tVars['task'] = $task;
        return \View::forge('missions/missions_interface', $tVars);
    }

    public static function parse_shortcodes(&$mission) {
        foreach($mission['servers'] as &$server) {
            $server['hostname'] = static::do_shortcode($mission, $server['hostname']);
        }

        foreach($mission['services'] as &$service) {
            $service['welcome'] = static::do_shortcode($mission, $service['welcome']);
        }

        foreach($mission['entities'] as &$entity) {
            $entity['content'] = static::do_shortcode($mission, $entity['content']);
            $entity['title'] = static::do_shortcode($mission, $entity['title']);
            $entity['owner'] = static::do_shortcode($mission, $entity['owner']);
        }

        if (isset($mission['connected'])) {
            $mission['connected']['username'] = static::do_shortcode(false, $mission['connected']['username']);
        }
    }

    public static function prepare_data($quest) {
        $mission = array('bouncers' => array());
        $q = \DB::select()->from('quest')->where('quest_id', $quest)->execute()->as_array()[0];
        $mission['servers'] = \DB::select()->from('quest_server')->where('quest_id', $quest)->execute()->as_array('quest_server_id');
        foreach($mission['servers'] as &$server) {
            $server['ip'] = static::ip();
        }

        $mission['services'] = \DB::select()->from('quest_server_service')->where('quest_id', $quest)->order_by('port', 'asc')->execute()->as_array('service_id');
        foreach ($mission['services'] as &$service) {
            $users = static::do_shortcode(false, html_entity_decode($service['users'], ENT_QUOTES));
            $users = explode(';', $users);

            $service['users'] = array();
            foreach ($users as $user) {
                $user = explode(':', $user);
                $service['users'][$user[0]] = array('security' => isset($user[2]) && $user[2] ? $user[2] : false, 'password' => isset($user[1]) && $user[1] ? $user[1] : false);
            }
            if (!$service['required_objective']) unset($service['required_objective']);
        }
        $user_servers = Servers::of(\Auth::get('id'));
        foreach($user_servers as $s) {
            $mission['servers'][-$s['server_id']] = array(
                'hostname' => $s['hostname'],
                'ip' => $s['ip'],
                'bounces' => 3,
                'discovered' => true,
                'network' => 0,
                'hide_hn' => false
                );
            $mission['services'][-$s['server_id']] = array(
                'quest_server_id' => -$s['server_id'],
                'type' => 1,
                'discovered' => true,
                'users' => array(\Auth::get('username') => array('security' => false, 'password' => false)),
                'port' => rand(22, 30),
                'welcome' => ''
                );
        }

        $mission['entities'] = \DB::select()->from('quest_service_entity')->where('quest_id', $quest)->order_by('title', 'asc')->execute()->as_array('entity_id');
        foreach($mission['entities'] as &$e) {
            if ($e['type'] == 3) {
                $e['required_running'] = array_filter(explode(',', $e['required_running']));
                foreach($e['required_running'] as &$rr) {
                    $rr = explode(':', $rr);
                }
            }
            if (!$e['required_objective']) unset($e['required_objective']);
        }

        $mission["objective"] = static::new_objective($mission, $quest);
        if ($q['default_connection']) {
            $con = explode(':', html_entity_decode($q['default_connection'], ENT_QUOTES));
            $mission['connected'] = array('service_id' => $con[1], 'username' => $con[0]);
        }

        static::parse_shortcodes($mission);

        $mission['skills_influence'] = Skills::influence_total(\Auth::get('skills'));

        return $mission;
    }


    public static function add_task(&$mission, $type, $duration, $data, $influence = false) {
        if ($influence) {
            if (isset($mission['skills_influence'][$influence])) {
                $duration = min(5, round($duration - ($duration / 100) * $mission['skills_influence'][$influence]));
            }
        }
    	$mission['task'] = array('task_start' => time(), 'task_duration' => $duration, 'type' => $type, 'data' => $data);
    }

    public static function new_objective($mission, $quest_id, $objective_order = -1) {
        $objective = \DB::select()->from('quest_objective')->where('parent_objective_id', 'IS', NULL)->where('quest_id', $quest_id)
            ->where('objective_order', '>', $objective_order)->order_by('objective_order', 'asc')->limit(1)->execute()->as_array();

            if (count($objective)) {
                $objective = $objective[0];
                $objective['story'] = static::do_shortcode($mission, $objective['story']);
                $objective['name'] = static::do_shortcode($mission, $objective['name']);
                $objective["sides"] = \DB::select()->from('quest_objective')->where('parent_objective_id', $objective['objective_id'])->execute()->as_array('objective_id');

                foreach($objective['sides'] as &$o) {
                    $o['data'] = static::do_shortcode($mission, $o['data']);
                }
                return $objective;
            }
        return false;
    }

    public static function objective_check(&$task, &$mission, $type, $data) {
    	$objective_done = true;
        if ($mission['objective'])
        	foreach ($mission['objective']['sides'] as &$side) {
        		if (isset($side['done'])) continue;
        		if ($side['type'] == $type && $side['data'] == $data) {
        			$side['done'] = true;
        		} elseif (!$side['optional']) {
        			$objective_done = false;
        		}
        	}

    	if ($objective_done) {
            if ($mission['objective']) {
                foreach($mission['entities'] as &$e)
                    if (isset($e['required_objective']) && $e['required_objective'] == $mission['objective']['objective_id'])
                        unset($e['required_objective']);
                foreach($mission['services'] as &$s)
                    if (isset($s['required_objective']) && $s['required_objective'] == $mission['objective']['objective_id'])
                        unset($s['required_objective']);
            }
    		$mission["objective"] = static::new_objective($mission, $mission['objective']['quest_id'], $mission['objective']['objective_order']);
    	}
    }

    public static function add_server($quest_id) {
        \DB::insert('quest_server')->set(array('quest_id' => $quest_id))->execute();
    }

    public static function delete_server($server_id, $quest_id) {
        \DB::delete('quest_server')->where('quest_server_id', $server_id)->where('quest_id', $quest_id)->execute();
        $services = \DB::select('service_id')->from('quest_server_service')->where('quest_server_id', $server_id)->execute()->as_array();
        foreach($services as $s) static::delete_service($s['service_id'], $quest_id);
    }
    public static function update_server($server_id, $quest_id, $data) {
        \DB::update('quest_server')->set($data)->where('quest_server_id', $server_id)->where('quest_id', $quest_id)->execute();
    }

    public static function add_entity($user_id, $quest_id, $parent_entity_id = 0) {
        \DB::insert('quest_user_entity')->set(array('user_id' => $user_id, 'quest_id' => $quest_id, 'parent_entity_id' => $parent_entity_id))->execute();
    }

    public static function update_entity($entity_id, $quest_id, $data) {
        \DB::update('quest_user_entity')->set($data)->where('entity_id', $entity_id)->where('quest_id', $quest_id)->execute();
    }

    public static function delete_entity($entity_id, $quest_id) {
        \DB::delete('quest_user_entity')->where('quest_id', $quest_id)->where(function($q) {
            return $q->where('entity_id', $entity_id)->or_where('parent_entity_id', $entity_id); })->execute();
    }

    public static function add_user($service_id, $quest_id) {
        \DB::insert('quest_service_user')->set(array('service_id' => $service_id, 'quest_id' => $quest_id, 'username' => 'user' . time()))->execute();
    }

    public static function update_user($user_id, $quest_id, $data) {
        \DB::update('quest_service_user')->set($data)->where('user_id', $user_id)->where('quest_id', $quest_id)->execute();
    }

    public static function delete_user($user_id, $quest_id) {
        \DB::delete('quest_service_user')->where('user_id', $user_id)->where('quest_id', $quest_id)->execute();
    }

    public static function add_service($server_id, $quest_id) {
        \DB::insert('quest_server_service')->set(array('quest_server_id' => $server_id, 'quest_id' => $quest_id))->execute();
    }

    public static function delete_service($service_id, $quest_id) {
        \DB::delete('quest_server_service')->where('service_id', $service_id)->where('quest_id', $quest_id)->execute();
        $entities = \DB::select('entity_id')->from('quest_service_entity')->where('service_id', $service_id)->execute()->as_array();
        foreach($entities as $e) static::delete_entity($e['entity_id'], $quest_id);
    }

    public static function update_service($service_id, $quest_id, $data) {
        \DB::update('quest_server_service')->set($data)->where('service_id', $service_id)->where('quest_id', $quest_id)->execute();
    }

    public static function ip() {
        return implode('.', array(mt_rand(1, 99), mt_rand(1, 255), mt_rand(1, 255), mt_rand(1, 255)));
    }
}
