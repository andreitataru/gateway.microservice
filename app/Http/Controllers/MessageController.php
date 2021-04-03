<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\MessageService; 

class MessageController extends Controller
{
    use ApiResponser;       

    /**
     * Messages's service
     * @var MessageService
     */
    public $MessageService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessageService $MessageService)
    {
        $this->MessageService = $MessageService;
    }


    /**
     * Send Message
     * @return Iluminate\Http\Response
     */
    public function SendMessage(Request $request)
    {
        $responseSendMessage = $this->MessageService->SendMessage($request->all());
        return $this->successResponse($responseSendMessage);
    }

    /**
     * Get Messages
     * @return Iluminate\Http\Response
     */
    public function GetMessages(Request $request)
    {
        $responseGetMessages = $this->MessageService->GetMessages($request->all());
        return $this->successResponse($responseGetMessages);
    }


    /**
     * Get Active Chats
     * @return Iluminate\Http\Response
     */
    public function GetActiveChats($userId)
    {
        $responseGetActiveChats = $this->MessageService->GetActiveChats($userId);
        return $this->successResponse($responseGetActiveChats);
    }



}
