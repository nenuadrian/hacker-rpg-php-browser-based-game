<?php

namespace Model;

class Conversation extends \Model {
    public static function create($title, $user_1, $user_2, $message) {
    	$conv = array(
			'title' => $title,
			'user_1_id' => $user_1,
			'user_2_id' => $user_2,
			'last_reply_timestamp' => time(),
			'last_replier_id' => $user_1,
			'message' => $message,
			'unseen' => 1
			);

		\DB::insert('conversation')->set($conv)->execute();
    return \DB::select('conversation_id')->from('conversation')->where('user_1_id', $user_1)->order_by('created_at', 'desc')->limit(1)->execute()->as_array()[0]['conversation_id'];
    }

}
