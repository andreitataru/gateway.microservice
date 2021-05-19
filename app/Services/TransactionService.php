<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class TransactionService
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
		$this->baseUri = config('services.transactions.base_uri');
		$this->secret = config('services.transactions.secret');
	}


    /**
     * Create an instance of transaction using the transaction's service
     * @return string
     */
	public function addTransaction($data)
	{
		return $this->performRequest('POST','/api/addTransaction', $data);
	}


}