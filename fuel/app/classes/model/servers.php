<?php

namespace Model;

class Servers extends \Model {

    public static function hacks() {
        return array(
            'grid_scan' => array(
                    'name' => 'Grid scan',
                    'description' => 'Scanning the grid for IP addresses'
                )
            );
    }

    public static function create($user_id, $server_components) {
        $server = array('hostname' => 'new server', 'user_id' => $user_id);
        $server['ram'] = $server_components['ram']['value'];
        $server['cpu'] = $server_components['cpu']['value'];
        $server['ssd'] = $server_components['ssd']['value'];

        $ip = Servers::ip();
        while(count(\DB::select('server_id')->from('server')->where('ip', $ip)->execute())) {}
        $server['ip'] = $ip;
    
        \DB::insert('server')->set($server)->execute();

        return true;
    }

    public static function of($user_id) {
        return \DB::select()->from('server')->where('user_id', $user_id)->execute()->as_array();
    }

    
    public static function check_resources_for_app($server, $app, $stats = array('cpu', 'ram', 'ssd')) {
        foreach($stats as $s)
            if (isset($app[$s]) && $server[$s] - $server[$s . '_used'] < $app[$s]) {
                return array('can' => false, 'reason' => $s);
            }
        return array('can' => true);
    }

    public static function can_add_app($server, $app) {
        return Servers::check_resources_for_app($server, $app, array('ssd'));
    }

    public static function can_run_app($server, $app) {
        return Servers::check_resources_for_app($server, $app, array('cpu', 'ram'));
    }

    public static function run_app($server, $app, $user_id = false) {
        $server['ram_used'] += $app['ram'];
        $server['cpu_used'] += $app['cpu'];
        Servers::save($server);
        \DB::update('server_app')->set(array('running' => 1))->where('server_app_id', $app['server_app_id'])->execute();
    }

    public static function kill_app(&$server, $app) {
        $server['ram_used'] -= $app['ram'];
        $server['cpu_used'] -= $app['cpu'];
        Servers::save($server);
         \DB::update('server_app')->set(array('running' => NULL))->where('server_app_id', $app['server_app_id'])->execute();
         Servers::save(array('server_id' => $server['server_id'], 'cpu_used' => $server['cpu_used'], 'ram_used' => $server['ram_used']));
    }

    public static function add_app(&$server, $app, $user_id = false) {
        $insertData = array('type' => $app['type'], 'server_id' => $server['server_id'], 'owner_id' => $user_id ? $user_id : \Auth::get('id'));
        \DB::insert('server_app')->set($insertData)->execute();
        $server_app_id = \DB::select('server_app_id')->from('server_app')->where('server_id', $server['server_id'])->order_by('server_app_id', 'desc')->limit(1)->execute()->as_array()[0]['server_app_id'];
        $server['ssd_used'] += $app['ssd'];
        Servers::save(array('server_id' => $server['server_id'], 'ssd_used' => $server['ssd_used']));
        return $server_app_id;
    }

    public static function get($server_id, $user_id = false) {
        $server = \DB::select()->where('server_id', $server_id)->from('server');

        if ($user_id) 
           $server->where('user_id', $user_id);

        $server = $server->execute()->as_array();
        $server = count($server) ? $server[0] : false;
        return $server;
    }

    public static function ip() {
        return implode('.', array(mt_rand(100, 255), mt_rand(1, 255), mt_rand(1, 255), mt_rand(1, 255)));
    }

    public static function save($server) {
        \DB::update('server')->set($server)->where('server_id', $server['server_id'])->execute();
    }

}