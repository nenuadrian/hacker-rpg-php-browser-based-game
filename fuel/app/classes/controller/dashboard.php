<?php
use \Model\Task;
use \Model\Quests;

class Controller_Dashboard extends Controller
{
	public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index() 
    {
    	$tasks = Task::get(Auth::get('id'));
    	$tVars = array();

        $availableQuests = Quests::missions(false, 6);
        
        $tVars['quote'] = DB::select()->from('hacker_quote')->order_by(DB::expr('RAND()'))->limit(1)->execute()->as_array()[0];
        $tVars['availableQuests'] = $availableQuests;
        $tVars['tasks'] = $tasks;
        return View::forge('dashboard/dashboard', $tVars);
    }
}
