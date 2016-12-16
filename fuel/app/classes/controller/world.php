<?php

class Controller_World extends Controller {
	public function action_index() {
    	$tVars = array();
        $rightSide = array();
        $leftSide = array();
				$active48 = time() - 48 * 60 * 60;

        $data = DB::query('select
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

        $leftSide[] = array('value' => $data['nrHackers'], 'title' => 'Hackers', 'description' => 'joined the Competition');
        $leftSide[] = array('value' => $data['nrQuests'], 'title' => 'Missions', 'description' => 'can be uncovered');
        $leftSide[] = array('value' => $data['nrRewards'], 'title' => 'Rewards', 'description' => 'obtained by hackers');
        $leftSide[] = array('value' => $data['nrDoneQuests'], 'title' => 'missions', 'description' => 'finished by hackers');
        $leftSide[] = array('value' => $data['nrHackerGroups'], 'title' => 'hacker groups', 'description' => 'have been created');
        $rightSide[] = array('value' => $wd, 'title' => 'Days', 'description' => 'since the new world');
				$rightSide[] = array('value' => $data['nrActive48'], 'title' => 'hackers connected', 'description' => 'in the last 24h');
				$rightSide[] = array('value' => $data['nrConvs'], 'title' => 'messages exchanged', 'description' => 'in conversations');
        $rightSide[] = array('value' => $data['nrMoney'], 'title' => '<i class="fa fa-cube"></i>', 'description' => 'in circulation');
				$rightSide[] = array('value' => $data['nrTasks'], 'title' => 'tasks', 'description' => 'done by hackers');

        $tVars['leftSide'] = $leftSide;
        $tVars['rightSide'] = $rightSide;
			return View::forge('world/world', $tVars);

    }
}
