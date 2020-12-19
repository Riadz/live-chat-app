<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () {
	return redirect(route('fetch_messages'));
});


$router->group(
	['prefix' => 'api'],
	function () use ($router) {

		// get messages
		$router->get(
			'/messages',
			['uses' => 'MessageController@fetch', 'as' => 'fetch_messages']
		);

		// store a message
		$router->post(
			'/messages',
			['uses' => 'MessageController@store', 'as' => 'store_messages']
		);
	}
);
