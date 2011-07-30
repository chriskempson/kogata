<?php
// Root
sc::route()->get('/', function() {
	$data['title'] = 'Kogata';
	$data['body'] = 'Welcome to Kogata!';
	sc::template('example', $data);
});

// Example
sc::route()->get('/example', array(nc::ExampleController(), 'index'));
sc::route()->get('/example/:action/:name', array(nc::ExampleController(), null));

// Default route
sc::route()->get(null, function() {
	header('HTTP/1.0 404 Not Found');
	echo 'Kogata 404';
});

// Dispatch routes!
sc::dispatch();
?>