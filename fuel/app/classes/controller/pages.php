<?php

class Controller_Pages extends Controller
{
	public function action_view($dir_or_page, $page = false) {
		$page = $page ? $dir_or_page . '/' . $page : $dir_or_page;
		if (!File::exists(APPPATH . 'views/pages/'. $page . '.php')) throw new HttpNotFoundException;
		return View::forge('pages/' . $page);
	}

}
