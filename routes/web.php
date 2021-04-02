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

	/**
	 * Users routes
	 */ 
	$router->options('/{any:.*}', function (Request $req) {
		return;
	  });
	$router->post('/api/register', 'UserController@register');
	$router->post('/api/login', 'UserController@login');
	$router->get('/api/profile', 'UserController@profile');
	$router->get('/api/checkToken', 'UserController@checkToken');
	$router->get('/api/users/{id}', 'UserController@singleUser');
	$router->get('/api/users', 'UserController@users');
	$router->post('/api/updateUser', 'UserController@updateUser');


//});




//para gerar app key
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});