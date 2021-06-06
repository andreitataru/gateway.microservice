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

    return Route::getRoutes();
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
		$router->post('/api/googleSignIn', 'UserController@googleSignIn');

		//CHAT MICROSERVICE
		$router->post('/api/SendMessage', 'MessageController@SendMessage');
		$router->post('/api/GetMessages', 'MessageController@GetMessages');
		$router->get('/api/GetActiveChats', 'MessageController@GetActiveChats');

		//HOUSE MICROSERVICE
		$router->post('/api/addHouse', 'HouseController@addHouse');
		$router->get('/api/getAllHouses', 'HouseController@getAllHouses');
		$router->get('/api/getHouseById/{id}', 'HouseController@getHouseById');   
		$router->post('/api/updateHouse', 'HouseController@updateHouse');
		$router->get('/api/deleteHouseById/{id}', 'HouseController@deleteHouseById');
		$router->post('/api/getHousesWithFilter', 'HouseController@getHousesWithFilter');
		$router->get('/api/getHousesWithOwnerId/{id}', 'HouseController@getHousesWithOwnerId');   
		$router->post('/api/addInterest', 'HouseController@addInterest');
		$router->get('/api/getInterestsByHouseId/{id}', 'HouseController@getInterestsByHouseId'); 
		$router->get('/api/getInterestsByUserId/{id}', 'HouseController@getInterestsByUserId');

		//SERVICE MICROSERVICE
		$router->post('/api/addService', 'ServiceController@addService');
		$router->get('/api/getAllServices', 'ServiceController@getAllServices');
		$router->get('/api/getServiceById/{id}', 'ServiceController@getServiceById');   
		$router->post('/api/updateService', 'ServiceController@updateService');
		$router->get('/api/deleteServiceById/{id}', 'ServiceController@deleteServiceById');
		$router->post('/api/getServicesWithFilter', 'ServiceController@getServicesWithFilter');

		//TRANSACTION MICROSERVICE
		$router->post('/api/addTransaction', 'TransactionController@addTransaction');
		$router->get('/api/getAllTransactions', 'TransactionController@getAllTransactions');
		$router->get('/api/getTransactionById/{id}', 'TransactionController@getTransactionById');   
		$router->get('/api/getTransactionByUserId/{id}', 'TransactionController@getTransactionByUserId');
		$router->post('/api/getTransactionsByDate', 'TransactionController@getTransactionsByDate');

		//CONTRACT MICROSERVICE
		$router->post('/api/addContract', 'ContractController@addContract');
		$router->get('/api/getAllContracts', 'ContractController@getAllContracts');
		$router->get('/api/getContractById/{id}', 'ContractController@getContractById');  
		$router->get('/api/getContractByUserId/{id}', 'ContractController@getContractByUserId');  

		//REVIEW MICROSERVICE
		$router->post('/api/addReview', 'ReviewController@addReview');
		$router->get('/api/getReviewById/{id}', 'ReviewController@getReviewById');
		$router->get('/api/getReviewsByTarget/{id}/{type}', 'ReviewController@getReviewsByTarget');   

	});
//});




//para gerar app key
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});