<?php

class Controller_Database extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index() 
    {
    	if (Input::post()) {
    		Response::redirect(Uri::create('database/search/' . Input::post('type') . '/' . urlencode(Input::post('query'))));
    	}
        return View::forge('database/database');
    }

    public function action_search($type, $query) {
    	$search = false;
    	$query = explode(' ', $query);

    	if ($type == 'hacker') {
    		$search = DB::select(array('username', 'name'))->from('users');
    		foreach($query as $k) $search = $search->where('username', 'LIKE', '%' . $k . '%');
    	} else {
    		$search = DB::select('name')->from('hacker_group');
    		foreach($query as $k) $search = $search->where('name', 'LIKE', '%' . $k . '%');
    	}
    	$tVars = array();
    	$results = $search->order_by('name', 'asc')->limit(100)->execute()->as_array();
    	$tVars['results'] = $results;
    	return View::forge('database/database_results', $tVars);
    }
}
