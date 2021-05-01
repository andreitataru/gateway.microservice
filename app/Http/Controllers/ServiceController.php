<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\ServiceService; 
use App\Services\UserService;

class ServiceController extends Controller
{
    use ApiResponser;       

    /**
     * User's service
     * @var UserService
     */
    public $UserService;

    /**
     * Messages's service
     * @var ServiceService
     */
    public $ServiceService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService, ServiceService $ServiceService)
    {
        $this->ServiceService = $ServiceService;
        $this->UserService = $UserService;
    }


        /**
     * Add Service
     * @return Iluminate\Http\Response
     */
    public function addService(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        //ServiceProvider
        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Host"){
            $request->request->add(['providerId' => $obj['accountId']]);
            $responseAddService = $this->ServiceService->addService($request->all());
            return $this->successResponse($responseAddService);
        }
        else {
            return $this->errorResponse("Error", 401);
        }

    }




}
