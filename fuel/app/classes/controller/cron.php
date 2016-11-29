<?php
use \Model\Task;

class Controller_Cron extends Controller
{
	/*public function action_apps_profit()
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
    }*/

		public function action_rankings() {
			$users = DB::select()->from('users')->execute()->as_array();
			foreach($users as $user) {
				$points = $user['level'] * 2;
				$skills = json_decode($user['skills'], true);
				if (is_array($skills)) foreach($skills as $s) $points += $s['level'];
				$knowledge = json_decode($user['knowledge'], true);
				if (is_array($knowledge)) foreach($knowledge as $s) $points += $s['level'];
				DB::update('users')->set(array('ranking_points' => $points))->where('id', $user['id'])->limit(1)->execute();
			}
			$users = DB::select('id', 'ranking_points')->from('users')->order_by('ranking_points', 'desc')->execute()->as_array();
			$rank = 1;
			foreach($users as $k => $user) {
				if ($k && $user['ranking_points'] < $users[$k - 1]['ranking_points']) $rank++;
				DB::update('users')->set(array('ranking' => $rank))->where('id', $user['id'])->limit(1)->execute();
			}
		}
}
