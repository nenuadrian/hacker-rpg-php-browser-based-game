<?php

class Controller_Dna extends Controller {
	public function __construct() { if (!Auth::check()) Response::redirect(Uri::base()); }

	public function action_index()  {
		if (Input::post('voice')) {
			DB::update('users')->set(array('voice_enabled' => !Auth::get('voice_enabled')))->where('id', Auth::get('id'))->execute();
			Messages::voice('data_saved2');
			Response::redirect(Uri::current());
		}
		return Response::forge(View::forge('dna/dna'))->set_header('Access-Control-Allow-Origin', '*');
    }

}
