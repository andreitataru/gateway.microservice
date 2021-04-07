<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class MessageService
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
		$this->baseUri = config('services.messages.base_uri');
		$this->secret = config('services.messages.secret');
	}


    /**
     * Create an instance of message using the message service
     * @return string
     */
	public function SendMessage($data)
	{
		return $this->performRequest('POST','/api/SendMessage', $data);
	}

	/**
	 * Get Messages of usedId with idReceiver
	 * @return string
	 */
	public function GetMessages($data)
	{
		return $this->performRequest('POST',"/api/GetMessages", $data);
	}

	/**
	 * Get Active Chats
	 * @return string
	 */
	public function GetActiveChats($userId)
	{
		return $this->performRequest('GET',"/api/GetActiveChats/{$userId}");
	}




}