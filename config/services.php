<?php

return [
	'users' => [
		'base_uri' => env('USERS_SERVICE_API_BASE_URL'),
		'secret' => env('USERS_SERVICE_API_SECRET')
	],
	'messages' => [
		'base_uri' => env('MESSAGES_SERVICE_API_BASE_URL'),
		'secret' => env('MESSAGES_SERVICE_API_SECRET')
	]

];