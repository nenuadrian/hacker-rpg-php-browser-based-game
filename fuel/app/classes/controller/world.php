<?php

class Controller_World extends Controller {
	public function action_index() {
			try {
				$tVars = \Cache::get('world2');
			} catch (Exception $ex) {
				$tVars = array();
					$active48 = time() - 48 * 60 * 60;

	        $values = DB::query('select
					(select sum(money) from users) nrMoney,
					(select count(*) from users where last_active <= ' . $active48 . ') nrActive48,
					(select sum(times) from user_mission) nrDoneQuests,
					(select count(*) from hacker_group) nrHackerGroups,
					(select count(*) from reward) nrRewards,
					(select count(*) from task) nrTasks,
					(select count(*) from conversation) nrConvs,
					(select count(*) from users) nrHackers,
					(select count(*) from quest q left outer join quest_group qg on qg.quest_group_id = q.quest_group_id where q.live = 1 and qg.type = 1) nrQuests
	            ')->execute()->as_array()[0];

							$now = time(); // or your date as well
						$your_date = strtotime("2016-11-01");
						$datediff = $now - $your_date;

						$wd = floor($datediff / (60 * 60 * 24));
					$data = array();
	        $data[] = array('value' => $values['nrHackers'], 'title' => 'Hackers', 'description' => 'joined the Competition');
	        $data[] = array('value' => $values['nrQuests'], 'title' => 'Missions', 'description' => 'can be uncovered');
	        $data[] = array('value' => $values['nrRewards'], 'title' => 'Rewards', 'description' => 'obtained by hackers');
	        $data[] = array('value' => $values['nrDoneQuests'], 'title' => 'missions', 'description' => 'finished by hackers');
	        $data[] = array('value' => $values['nrHackerGroups'], 'title' => 'hacker groups', 'description' => 'have been created');
	        $data[] = array('value' => $wd, 'title' => 'Days', 'description' => 'since the new world');
					$data[] = array('value' => $values['nrActive48'], 'title' => 'hackers connected', 'description' => 'in the last 24h');
					$data[] = array('value' => $values['nrConvs'], 'title' => 'messages exchanged', 'description' => 'in conversations');
	        $data[] = array('value' => $values['nrMoney'], 'title' => '<i class="fa fa-cube"></i>', 'description' => 'in circulation');
					$data[] = array('value' => $values['nrTasks'], 'title' => 'tasks', 'description' => 'done by hackers');

	        $tVars['data'] = $data;

				\Cache::set('world2', $tVars, 3 * 60 * 60);
			}

			return View::forge('world/world', $tVars);

    }
}
