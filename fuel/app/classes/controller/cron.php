<?php
use \Model\Task;

class Controller_Cron extends Controller
{
	public function action_apps_profit() 
    {
    	$servers = DB::select('server_id', 'last_apps_profit_check')->from('server')->execute()->as_array();
    	foreach($servers as $server) {
    		$apps = DB::select()->from('server_app')->where('server_id', $server['server_id'])->execute()->as_array();
    		foreach($apps as $app) {
    			if ($app['running'] && isset(Config::get('apps')[$app['type']]['money_maker'])) {
    				$profit = 2;
    				DB::update('users')->set(array('money' => DB::expr('money + ' . $profit)))->where('id', $app['owner_id'])->limit(1)->execute();
    			}
    		}
    	}
    	DB::update('server')->set(array('last_apps_profit_check' => time()))->execute();
    }
}
