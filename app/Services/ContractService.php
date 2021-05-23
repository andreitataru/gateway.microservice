<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class ContractService
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
		$this->baseUri = config('services.contracts.base_uri');
		$this->secret = config('services.contracts.secret');
	}


    /**
     * Create an instance of service using the contract's service
     * @return string
     */
	public function addContract($data)
	{
		return $this->performRequest('POST','/api/addContract', $data);
	}

	/**
	 * Get all contracts
	 * @return string
	 */
	public function getAllContracts()
	{
		return $this->performRequest('GET',"/api/getAllContracts");
	}

	/**
	 * Get contract by id
	 * @return string
	 */
	public function getContractById($id)
	{
		return $this->performRequest('GET',"/api/getContractById/{$id}");
	}

	/**
	 * Get contract by UserId
	 * @return string
	 */
	public function getContractByUserId($id)
	{
		return $this->performRequest('GET',"/api/getContractByUserId/{$id}");
	}



}