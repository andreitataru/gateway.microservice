<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class UserService
{
	use ConsumesExternalServices;

	/**
	 * The base uri to be used to consume the Users service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the Users service
	 * @var string
	 */
	public $secret;

	public function __construct()
	{
		$this->baseUri = config('services.users.base_uri');
		$this->secret = config('services.users.secret');
	}


    /**
     * Create an instance of author using the users service
     * @return string
     */
	public function register($data)
	{
		return $this->performRequest('POST','/api/register', $data);
	}

	/**
	 * Get the single of author from the author service
	 * @return string
	 */
	public function login($data)
	{
		return $this->performRequest('POST',"/api/login", $data);
	}

	/**
	 * Get the single of author from the author service
	 * @return string
	 */
	public function profile($data, $headers)
	{
		return $this->performRequest('GET',"/api/profile", $data, $headers);
	}


	/**
	 * Get the single of author from the author service
	 * @return string
	 */
	public function checkToken($data, $headers)
	{
		return $this->performRequest('GET',"/api/checkToken", $data, $headers);
	}

	/**
	 * Get Single User
	 * @return string
	 */
	public function singleUser($data, $headers, $id)
	{
		return $this->performRequest('GET',"/api/users/{$id}", $data, $headers);
	}

	/**
	 * Get All Users
	 * @return string
	 */
	public function users($data, $headers)
	{
		return $this->performRequest('GET',"/api/users", $data, $headers);
	}


	/**
	 * Update user info related to token
	 * @return string
	 */
	public function updateUser($data, $token)
	{
		$headers = [];
		$headers['Authorization'] = [$token];
	

		return $this->performRequest('POST',"/api/updateUser", $data, $headers);
	}



}