<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


//$router->group(['middleware' => 'client.credentials'], function() use ($router){


	$router->group(['middleware' => 'cors'], function () use ($router) {
		//All the routes you want to allow CORS for

		/**
	 	* Users routes
	 	*/ 
		$router->options('/{any:.*}', function (Request $req) {
			return;
		});
		
		//USER MICROSERVICE
		$router->post('/api/register', 'UserController@register');
		$router->post('/api/login', 'UserController@login');
		$router->get('/api/profile', 'UserController@profile');
		$router->get('/api/checkToken', 'UserController@checkToken');
		$router->get('/api/users/{id}', 'UserController@singleUser');
		$router->get('/api/users', 'UserController@users');
		$router->post('/api/updateUser', 'UserController@updateUser');

		//CHAT MICROSERVICE
		$router->post('/api/SendMessage', 'MessageController@SendMessage');
		$router->post('/api/GetMessages', 'MessageController@GetMessages');
		$router->get('/api/GetActiveChats/{userId}', 'MessageController@GetActiveChats');

		//HOUSE MICROSERVICE
		$router->post('/api/addHouse', 'HouseController@addHouse');
		$router->get('/api/getAllHouses', 'HouseController@getAllHouses');
		$router->get('/api/getHouseById/{id}', 'HouseController@getHouseById');   
		$router->post('/api/updateHouse', 'HouseController@updateHouse');
		$router->get('/api/deleteHouseById/{id}', 'HouseController@deleteHouseById');
		$router->post('/api/getHousesWithFilter', 'HouseController@getHousesWithFilter');


	});
//});




//para gerar app key
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});