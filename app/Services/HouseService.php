<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class HouseService
{
	use ConsumesExternalServices;

	/**
	 * The base uri to be used to consume the Houses's service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the houses's service
	 * @var string
	 */
	public $secret;

	public function __construct()
	{
		$this->baseUri = config('services.houses.base_uri');
		$this->secret = config('services.houses.secret');
	}


    /**
     * Create an instance of house using the house service
     * @return string
     */
	public function addHouse($data)
	{
		return $this->performRequest('POST','/api/addHouse', $data);
	}

	/**
	 * Get all houses
	 * @return string
	 */
	public function getAllHouses()
	{
		return $this->performRequest('GET',"/api/getAllHouses");
	}

	/**
	 * Get house by id
	 * @return string
	 */
	public function getHouseById($id)
	{
		return $this->performRequest('GET',"/api/getHouseById/{$id}");
	}

	/**
     * Update house
     * @return string
     */
	public function updateHouse($data)
	{
		return $this->performRequest('POST','/api/updateHouse', $data);
	}

	/**
	 * Get house by id
	 * @return string
	 */
	public function deleteHouseById($id)
	{
		return $this->performRequest('GET',"/api/deleteHouseById/{$id}");
	}

	/**
     * Get Houses with filter
     * @return string
     */
	public function getHousesWithFilter($data)
	{
		return $this->performRequest('POST','/api/getHousesWithFilter', $data);
	}

	/**
	 * Get houses by hostId
	 * @return string
	 */
	public function getHousesWithOwnerId($id)
	{
		return $this->performRequest('GET',"/api/getHousesWithOwnerId/{$id}");
	}

	/**
     * Create an instance of interest using the house service
     * @return string
     */
	public function addInterest($data)
	{
		return $this->performRequest('POST','/api/addInterest', $data);
	}


	/**
	 * Get interests by houseId
	 * @return string
	 */
	public function getInterestsByHouseId($id)
	{
		return $this->performRequest('GET',"/api/getInterestsByHouseId/{$id}");
	}
	

	/**
	 * Get interests by userId
	 * @return string
	 */
	public function getInterestsByUserId($id)
	{
		return $this->performRequest('GET',"/api/getInterestsByUserId/{$id}");
	}

	/**
     * Rate House
     * @return string
     */
	public function rateHouse($data)
	{
		return $this->performRequest('POST','/api/rateHouse', $data);
	}


}