<?php

class Controller_Feedback extends Controller
{
	public function action_index() {
    if (Input::post()) {
			if (strlen(Input::post('message')) < 10) {
				Messages::error('Please give us at least 10 characters describing your thoughts :)');
				Response::redirect(Uri::current());
			}
      DB::insert('feedback')->set(array('user_id' => Auth::get('id'), 'data' => json_encode(Input::post())))->execute();
      Messages::success("Thank you, " . Auth::get('username') . "! We've received your submission and we'll get back to you shortly if needed!");
      Response::redirect(Uri::current());
    }
    return View::forge('feedback/feedback');
  }

}
