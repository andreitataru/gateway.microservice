<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class ServiceService
{
	use ConsumesExternalServices;

	/**
	 * The base uri to be used to consume the service's service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the service's service
	 * @var string
	 */
	public $secret;

	public function __construct()
	{
		$this->baseUri = config('services.services.base_uri');
		$this->secret = config('services.services.secret');
	}


    /**
     * Create an instance of service using the service's service
     * @return string
     */
	public function addService($data)
	{
		return $this->performRequest('POST','/api/addService', $data);
	}


}