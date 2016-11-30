<?php

class Controller_World extends Controller
{
	public function action_index()
    {
    	$tVars = array();
        $rightSide = array();
        $leftSide = array();

        $data = DB::query('select
            (select count(*) from users) nrHackers
            ')->execute()->as_array()[0];

        $leftSide[] = array('value' => $data['nrHackers'], 'title' => 'Hackers', 'description' => 'Joined the Competition');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $leftSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $rightSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $rightSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $rightSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');
        $rightSide[] = array('value' => 2, 'title' => 'test', 'description' => 'desc');

        $tVars['leftSide'] = $leftSide;
        $tVars['rightSide'] = $rightSide;
			return Response::forge(View::forge('world/world', $tVars))->set_header('Access-Control-Allow-Origin', '*');

    }
}
