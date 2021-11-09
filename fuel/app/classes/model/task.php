<?php
namespace Model;

use \Model\Conversation;
use \Model\Knowledge;
use \Model\Apps;
use \Model\Servers;

class Task extends \Model {

    public static function create_for_server($user_id, $server_id, $type, $duration, $data, $data_id = NULL) {
        $task = array(
            'user_id' => $user_id,
            'server_id' => $server_id,
            'task_type' => $type,
            'task_duration' => $duration,
            'task_start' => time(),
            'data' => json_encode($data),
            'data_id' => $data_id
            );
        \DB::insert('task')->set($task)->execute();
    }

    public static function create($user_id, $type, $duration, $data, $data_id = NULL) {
        $task = array(
            'user_id' => $user_id,
            'task_type' => $type,
            'task_duration' => $duration,
            'task_start' => time(),
            'data' => json_encode($data),
            'data_id' => $data_id
            );
        \DB::insert('task')->set($task)->execute();
    }

    public static function get_one($user_id, $type) {
        $tasks = Task::get($user_id, $type);
        return count($tasks) ? $tasks[0] : false;
    }

    public static function get_for_server($server_id, $type = false) {
        $tasks = \DB::select()->from('task')->where('complete', 'IS', NULL)->where('server_id', $server_id);
        if ($type) $tasks = $tasks->where('task_type', $type);
        $tasks = $tasks->execute()->as_array();
        Task::process($tasks);
        return $tasks;
    }

    public static function process(&$tasks) {
        foreach($tasks as $k => &$task) {
            $task['data'] = json_decode($task['data'], true);

            $task['remaining'] = max(0, $task['task_start'] + $task['task_duration'] - time());
            if (!$task['remaining']) {
                $task['complete'] = time();
                if ($task['server_id']) {
                    if ($task['task_type'] == 6) {
                        $server = \DB::select('server_id')->from('server')->where('ip', $task['data']['target'])->execute()->as_array();
                        if (count($server)) {
                            $server = Servers::get($server[0]['server_id']);
                            $app = $task['data']['app'];
                            $app = Apps::process($app);
                            if (Servers::can_add_app($server, $app)['can']) {
                                $app['server_app_id'] = Servers::add_app($server, $app, $task['user_id']);
                                if (Servers::can_run_app($server, $app)['can']) {
                                    Servers::run_app($server, $app);
                                }
                            }
                        }
                    } elseif ($task['task_type'] == 5) {
                        $profit = 2;
                        \DB::update('user')->set(array('money' => \DB::expr('money + ' . $profit)))->where('user_id', $task['user_id'])->limit(1)->execute();
                        // TODO substract from target
                    } elseif ($task['task_type'] == 3) {
                        $report = '192.168.1.1';
                        Conversation::create('Scan Report', -1, $task['user_id'], $report);
                    }
                } elseif ($task['task_type'] == 4) {
                    $user = \DB::select('knowledge', 'skills')->from('user')->where('user_id', $task['user_id'])->limit(1)->execute()->as_array()[0];
                    $knowledge = Knowledge::process($user['knowledge']);
                    $knowledge[$task['data']['knowledge']]['level'] += 1;
                    $skills = Skills::process($user['skills']);
                    foreach($knowledge[$task['data']['knowledge']]['skills'] as $id => $v) {
                         Skills::add_experience($skills[$id], $v);
                    }
                    Skills::save($task['user_id'], $skills);
                    Knowledge::save($task['user_id'], $knowledge);
                }

                Task::save($task);
                \Response::redirect(\Uri::current());
            }
        }
    }

    public static function get($user_id, $type = false) {
        $tasks = \DB::select()->from('task')->where('complete', 'IS', NULL)->where('cancelled', 'IS', NULL)->where('user_id', $user_id);
        if ($type) $tasks = $tasks->where('task_type', $type);
        $tasks = $tasks->execute()->as_array();
        Task::process($tasks);
        return $tasks;
    }

    public static function save($task) {
        $updateTask = array();
        $updateTask['data'] = json_encode($task['data']);
        if (isset($task['complete'])) $updateTask['complete'] = $task['complete'];
        \DB::update('task')->set($updateTask)->where('task_id', $task['task_id'])->execute();
    }
}
