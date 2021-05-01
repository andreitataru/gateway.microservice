<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\MessageService; 
use App\Services\UserService;

class MessageController extends Controller
{
    use ApiResponser;       

    /**
     * User's service
     * @var UserService
     */
    public $UserService;

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
    public function __construct(UserService $UserService, MessageService $MessageService)
    {
        $this->MessageService = $MessageService;
        $this->UserService = $UserService;
    }


    /**
     * Send Message
     * @return Iluminate\Http\Response
     */
    public function SendMessage(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid"){
            $request->request->add(['userId' => $obj['accountId']]);
            $responseSendMessage = $this->MessageService->SendMessage($request->all());
            return $this->successResponse($responseSendMessage);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
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
    public function GetActiveChats(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid"){
            $responseGetActiveChats = $this->MessageService->GetActiveChats($obj['accountId']);
            return $this->successResponse($responseGetActiveChats);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
        
    }



}
