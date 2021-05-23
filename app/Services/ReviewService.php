<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class ReviewService
{
	use ConsumesExternalServices;

	/**
	 * The base uri to be used to consume the review's service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the review's service
	 * @var string
	 */
	public $secret;

	public function __construct()
	{
		$this->baseUri = config('services.reviews.base_uri');
		$this->secret = config('services.reviews.secret');
	}


    /**
     * Create an instance of service using the review's service
     * @return string
     */
	public function addReview($data)
	{
		return $this->performRequest('POST','/api/addReview', $data);
	}

	/**
	 * Get review by id
	 * @return string
	 */
	public function getReviewById($id)
	{
		return $this->performRequest('GET',"/api/getReviewById/{$id}");
	}

	/**
	 * Get review by target
	 * @return string
	 */
	public function getReviewsByTarget($id, $type)
	{
		return $this->performRequest('GET',"/api/getReviewsByTarget/{$id}/{$type}");
	}

}