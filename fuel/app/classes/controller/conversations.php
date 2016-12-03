<?php
use \Model\Conversation;

class Controller_Conversations extends Controller
{
	public function __construct() { if (!Auth::check()) Response::redirect(Uri::base()); }
	public function action_conversation($conv) {
		$conv = DB::select('conversation_id', 'title', 'user_1_id', 'user_2_id', 'unseen', 'last_replier_id')->from('conversation')->where('conversation_id', $conv)->where('parent_conversation_id', 'IS', NULL)->where(function($q) {
				return $q->where('user_1_id', Auth::get('id'))->or_where('user_2_id', Auth::get('id'));
			})->execute()->as_array();
		$conv = $conv[0];

		if ($conv['unseen'] && $conv['last_replier_id'] != Auth::get('id')) {
			DB::update('conversation')->set(array('unseen' => NULL))->where('conversation_id', $conv['conversation_id'])->execute();
		}

		if (Input::post()) {
			$reply = array(
				'user_1_id' => Auth::get('id'),
				'parent_conversation_id' => $conv['conversation_id'],
				'message' => Input::post('message')
				);
			DB::insert('conversation')->set($reply)->execute();

			$conv['last_replier_id'] = Auth::get('id');
			$conv['unseen'] = 1;
			$conv['last_reply_timestamp'] = time();
			DB::update('conversation')->set($conv)->where('conversation_id', $conv['conversation_id'])->execute();
		}
		$replies = DB::select()->from('conversation')->where('parent_conversation_id', $conv['conversation_id'])->or_where('conversation_id', $conv['conversation_id'])->order_by('created_at', 'desc')->execute()->as_array();

		$bbcode = new Golonka\BBCode\BBCodeParser;

		foreach ($replies as &$r) {
			$r['message'] = $bbcode->parseCaseInsensitive(htmlentities(htmlentities($r['message'])));
		}

		$tVars = array();
		$tVars['replies'] = $replies;
		$tVars['conv'] = $conv;
				return View::forge('conversations/conversation', $tVars);
	}

	public function action_new() {
		$tVars = array();

		if (Input::post() && Input::post('username') != Auth::get('username')) {
			$user_2_id = DB::select('id')->from('users')->where('username', Input::post('username'))->execute()->as_array();
			if (!$user_2_id) {
				Messages::error('Target not found!');
			} else {
				$c_id = Conversation::create(Input::post('title'), Auth::get('id'), $user_2_id[0]['id'], Input::post('message'));
				Response::redirect(Uri::create('conversations/conversation/' . $c_id));
			}
		}

		return View::forge('conversations/conversation_new', $tVars);
	}

	public function action_index()
    {
    	$tVars = array();

    	$convs = DB::select()->from('conversation')->where('parent_conversation_id', 'IS', NULL)->where(function($q) {
    		return $q->where('user_1_id', Auth::get('id'))->or_where('user_2_id', Auth::get('id'));
    	})->order_by('last_reply_timestamp', 'desc')->execute()->as_array();

    	$other_participants = array();
    	foreach ($convs as &$c) {
    		$c['op'] = $c['user_1_id'] == Auth::get('id') ? $c['user_2_id'] : $c['user_1_id'];
    		$other_participants[] = $c['op'];
    	}

    	$op_usernames = array();
    	if (count($other_participants)) {
	    	$other_participants = DB::select('username', 'id')->from('users')->where('id', 'IN', $other_participants)->execute()->as_array();

	    	foreach($other_participants as $op) {
	    		$op_usernames[$op['id']] = $op['username'];
	    	}
		}
		$op_usernames[-1] = 'System';
    	$tVars['op_usernames'] = $op_usernames;
    	$tVars['convs'] = $convs;
				return View::forge('conversations/conversations', $tVars);

    }
}
