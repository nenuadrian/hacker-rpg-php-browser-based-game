<?php

namespace Model;

class Apps extends \Model {

   
    public static function process($app) {
        $processed = array_merge($app, \Config::get('apps')[$app['type']]);
        return $processed;
    }

    public static function get($server_id) {
    	$apps = \DB::select()->from('server_app')->where('server_id', $server_id)->execute()->as_array();
    	foreach($apps as &$a) {
            $a = Apps::process($a);
        }
        return $apps;
    }
    
}