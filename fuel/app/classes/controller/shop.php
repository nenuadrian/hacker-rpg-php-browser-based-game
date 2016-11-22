<?php
use \Model\Skills;
use \Model\Hacker;
use \Model\Servers;
use \Model\Apps;

class Controller_Shop extends Controller
{
    public function __construct() {
        if (!Auth::check()) Response::redirect(Uri::base());
    }
    
    var $shop = array(
            array('item_id' => 1, 'app' => array('type' => 1), 'price' => 1000),
            array('item_id' => 2, 'app' => array('type' => 2), 'price' => 1000),
            array('item_id' => 3, 'app' => array('type' => 3), 'price' => 1000),
            array('item_id' => 4, 'app' => array('type' => 4), 'price' => 1000),
            array('item_id' => 5, 'app' => array('type' => 5), 'price' => 1000),
            array('item_id' => 6, 'app' => array('type' => 6), 'price' => 1000)
        );

	public function action_index() 
    {
    	$tVars = array();

    	foreach($this->shop as &$i) {
    		$i['app'] = Apps::process($i['app']);
    	}

    	$tVars['shop'] = $this->shop;
        return View::forge('shop/shop', $tVars);
    }

    public function action_buy($item_id) {
        $tVars = array();
        foreach($this->shop as $item) if ($item['item_id'] == $item_id) break;
        $item['app'] = Apps::process($item['app']);

        if (Auth::get('money') >= $item['price']) { 
            if (Input::post()) {
                $server = Servers::get(Input::post('server'), Auth::get('id'));
                if (Servers::can_add_app($server, $item['app'])['can']) {
                    Hacker::save(array('money' => Auth::get('money') - $item['price']));
                
                    Servers::add_app($server, $item['app']);
                    Response::redirect(Uri::create('shop'));
                }
            }
        }
        $servers = Servers::of(Auth::get('id'));
        $tVars['servers'] = $servers;
        $tVars['item'] = $item;
        return View::forge('shop/shop_server', $tVars);
    }
}
