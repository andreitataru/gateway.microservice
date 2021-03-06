<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\ContractService; 
use App\Services\UserService;
use App\Services\HouseService;

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
     * House's service
     * @var HouseService
     */
    public $HouseService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService, ContractService $ContractService, HouseService $HouseService)
    {
        $this->ContractService = $ContractService;
        $this->UserService = $UserService;
        $this->HouseService = $HouseService;
    }


    /**
     * Add Contract
     * @return Iluminate\Http\Response
     */
    public function addContract(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);
        //&& $obj['accountType'] == "Host"
        if ($obj['status'] == "Token Valid"){
            $responseAddContract = $this->ContractService->addContract($request->all());
            $resObj = json_decode($responseAddContract, true);
            if ($resObj['message'] == "CREATED"){
                $request->request->add(['dateAvailable' => $request->endContract]);
                $this->HouseService->updateHouse($request->all());
            }
            return $this->successResponse($responseAddContract);

        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

    /**
     * Get Contracts
     * @return Iluminate\Http\Response
     */
    public function getAllContracts(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Admin"){
            $responseGetAllContracts = $this->ContractService->getAllContracts();
            return $this->successResponse($responseGetAllContracts);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
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
