<?php
return array(
	'_root_'  => 'messages/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	//''   => 'public'
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);