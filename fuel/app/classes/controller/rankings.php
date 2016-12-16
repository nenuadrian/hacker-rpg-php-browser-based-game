<?php

class Controller_Rankings extends Controller
{
	public function action_index()
    {
    	$tVars = array();

		$result = DB::select(DB::expr('COUNT(*) as count'))->from('users')->where('ranking', '!=', 0)->execute();

    	$config = array(
			    'pagination_url' => Uri::create('rankings'),
			    'total_items'    => $result->current()['count'],
			    'per_page'       => 20,
			    //'uri_segment'    => 3,
			    'uri_segment'    => 'page',
			);
    	$pagination = Pagination::forge('mypagination', $config);

    	$rankings = DB::select('id', 'username', 'ranking', 'ranking_points')->from('users')->where('ranking', '!=', 0)
    						->limit($pagination->per_page)
                            ->offset($pagination->offset)
                            ->execute()->as_array();

    	$tVars['rankings'] = $rankings;
    	$tVars['pagination'] = $pagination;

				return Response::forge(View::forge('rankings/rankings', $tVars))->set_header('Access-Control-Allow-Origin', '*');
    }

    public function action_groups()
    {
    	$tVars = array();

		$result = DB::select(DB::expr('COUNT(*) as count'))->from('hacker_group')->where('ranking', '!=', 0)->execute();

    	$config = array(
		    'pagination_url' => Uri::create('rankings'),
		    'total_items'    => $result->current()['count'],
		    'per_page'       => 20,
		    //'uri_segment'    => 3,
		    'uri_segment'    => 'page',
		);
    	$pagination = Pagination::forge('mypagination', $config);

    	$rankings = DB::select('hacker_group_id', 'name', 'ranking', 'ranking_points')->from('hacker_group')->where('ranking', '!=', 0)
    						->limit($pagination->per_page)
                            ->offset($pagination->offset)
                            ->execute()->as_array();

    	$tVars['rankings'] = $rankings;
    	$tVars['pagination'] = $pagination;
			return Response::forge(View::forge('rankings/rankings_groups', $tVars))->set_header('Access-Control-Allow-Origin', '*');
    }
}
