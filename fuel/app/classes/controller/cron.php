<?php
use \Model\Task;

class Controller_Cron extends Controller {
/* public function action_apps_profit() {
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
	
	public function action_emails($hash) {
		if ($hash != Config::get('cron_hash')) {
			die('Access denied - nice try');
		}

		$queue = DB::select()->from('email_queue')->where('processed_at', 'IS', NULL)->limit(5)->execute()->as_array('queue_id');
		foreach($queue as $queue_id => $q) {
			try {
				\Model\Emails::process_queued_email($q);
				DB::update('email_queue')->set(['processed_at' => DB::expr('NOW()')])->execute();
			} catch (Exception $ex) {
				print_r($ex);
			}
		}
	}
	
	public function action_rankings($hash) {
		if ($hash != Config::get('cron_hash')) {
			die('Access denied - nice try');
		}
		
		$users = DB::select()->from('user')->execute()->as_array();
		foreach($users as $user) {
			$points = $user['level'] * 2;
			$skills = json_decode($user['skills'], true);
			if (is_array($skills)) foreach($skills as $s) $points += $s['level'];
			$knowledge = json_decode($user['knowledge'], true);
			$knowledge_points = 0;
			$knwoledge_levels = [];
			for ($i = 0; $i <= 10000; $i++) $knowledge_levels[$i] = 0;
			if (is_array($knowledge)) foreach($knowledge as $s)  {
				$knowledge_levels[$s['level']]++;
			}
			for ($i = 0; $i <= 10000; $i++) {
				$knowledge_points += $i * $knowledge_levels[$i];
			}
			
		$points += $knowledge_points;

			Hacker::update(array('ranking_points' => $points, 'knowledge_points' => $knowledge_points), $user['user_id']);
		}
		$users = DB::select('user_id', 'ranking_points')->from('user')->order_by('ranking_points', 'desc')->execute()->as_array();
		$rank = 1;
		foreach($users as $k => $user) {
			if ($k && $user['ranking_points'] < $users[$k - 1]['ranking_points']) $rank++;
			Hacker::update(array('ranking' => $rank), $user['user_id']);
		}
	}
}
