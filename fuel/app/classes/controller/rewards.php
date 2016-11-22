<?php
use \Model\Rewards;

class Controller_Rewards extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
	public function action_index()
    {
    	$tVars = array();

    	$rewards = DB::select()->from('reward')->where('user_id', Auth::get('id'))->execute()->as_array();

    	$tVars['rewards'] = $rewards;
        return View::forge('rewards/rewards', $tVars);
    }

    public function action_reward($reward)
    {
    	$tVars = array();

    	$reward = DB::select()->from('reward')->where('user_id', Auth::get('id'))->where('reward_id', $reward)->execute()->as_array();
    	$reward = $reward[0];

    	if (Input::post('claim')) {
    		Rewards::claim($reward);
    		Response::redirect(Uri::current());
    	}
    	$tVars['reward'] = $reward;
        return View::forge('rewards/reward', $tVars);
    }
}
