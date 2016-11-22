<?php

class Controller_Voice extends Controller
{
    public function __construct() {}
    
	public function action_speak($id, $type = 'mp3') 
    {
    	$location = APPPATH . 'voice/' . $type . '/';
        $file = $location . $id . '.' . $type;
        if (File::exists($file)) {
            header('Content-Type: ' . mime_content_type($file));
            readfile($file);
        }
    }
}
