<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\ContractService; 
use App\Services\UserService;

class ContractController extends Controller
{
    use ApiResponser;       

    /**
     * User's service
     * @var UserService
     */
    public $UserService;

    /**
     * Contract's service
     * @var ContractService
     */
    public $ContractService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService, ContractService $ContractService)
    {
        $this->ContractService = $ContractService;
        $this->UserService = $UserService;
    }


    /**
     * Add Service
     * @return Iluminate\Http\Response
     */
    public function addContract(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        //ServiceProvider
        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Host"){
            if ($obj['accountId'] == $request->hostId){
                $responseAddContract = $this->ContractService->addContract($request->all());
                return $this->successResponse($responseAddContract);
            }
            else{
                return $this->errorResponse("Error", 401);
            }

        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

    /**
     * Get Services
     * @return Iluminate\Http\Response
     */
    public function getAllContracts()
    {
        $responseGetAllContracts = $this->ContractService->getAllContracts();
        return $this->successResponse($responseGetAllContracts);
    }

    /**
     * Get contract by id
     * @return Iluminate\Http\Response
     */
    public function getContractById($id)
    {
        $responseGetContractById = $this->ContractService->getContractById($id);
        return $this->successResponse($responseGetContractById);
    }

    /**
     * Get contract by userId
     * @return Iluminate\Http\Response
     */
    public function getContractByUserId($id)
    {
        $responseGetContractByUserId = $this->ContractService->getContractByUserId($id);
        return $this->successResponse($responseGetContractByUserId);
    }

}
