<?php

class Controller_Pages extends Controller
{
	public function action_index($page) 
    {
        return View::forge('pages/' . $page);
    }

}
