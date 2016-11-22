<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'create-account' => 'authenticate/register',
	'privacy-policty' => 'pages/index/privacy_policy',
	'terms-of-services' => 'pages/index/tos',
);
