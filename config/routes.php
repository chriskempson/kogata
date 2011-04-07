<?php
// Root
rc::route()->get('/', function() {
	$data['title'] = 'Kogata';
	$data['body'] = 'Welcome to Kogata!';
	rc::template('example', $data);
});

// Example
rc::route()->get('/example', array(nc::ExampleController(), 'index'));
rc::route()->get('/example/:action/:name', array(nc::ExampleController(), null));

// Default route
rc::route()->get(null, function() {
	header('HTTP/1.0 404 Not Found');
	echo 'Kogata 404';
});

// Dispatch routes!
rc::dispatch();
?>