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
     * Service's service
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
        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "ServiceProvider"){
            $request->request->add(['providerId' => $obj['accountId']]);
            $responseAddService = $this->ServiceService->addService($request->all());
            return $this->successResponse($responseAddService);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

    /**
     * Get Services
     * @return Iluminate\Http\Response
     */
    public function getAllServices()
    {
        $responseGetAllServices = $this->ServiceService->getAllServices();
        return $this->successResponse($responseGetAllServices);
    }

    /**
     * Get service by id
     * @return Iluminate\Http\Response
     */
    public function getServiceById($id)
    {
        $responseGetServiceById = $this->ServiceService->getServiceById($id);
        return $this->successResponse($responseGetServiceById);
    }

    public function updateService(Request $request)
    {
        //validar token e tipo de conta
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        $obj = json_decode($responsecheckToken, true);

        //deixar só o dono do service fazer alterações
        $responseGetServiceById = $this->ServiceService->getServiceById($request->serviceId);
        $serviceObj = json_decode($responseGetServiceById, true);

        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "ServiceProvider" && $obj['accountId'] == $serviceObj['service']['providerId']){
            $responseUpdateService = $this->ServiceService->updateService($request->all());
            return $this->successResponse($responseUpdateService);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

     /**
     * Delete Service by Id
     * @return Iluminate\Http\Response
     */
    public function deleteServiceById($id, Request $request)
    {
        //validar token e tipo de conta
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        $obj = json_decode($responsecheckToken, true);

        //deixar só o dono do service apagar o service
        $responseGetServiceById = $this->ServiceService->GetServiceById($id);
        $serviceObj = json_decode($responseGetServiceById, true);
        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "ServiceProvider" && $obj['accountId'] == $serviceObj['service']['providerId']){
            $responseDeleteServiceById = $this->ServiceService->deleteServiceById($id);
            return $this->successResponse($responseDeleteServiceById);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }


    /**
     * Get Services with filters
     * @return Iluminate\Http\Response
     */
    public function getServicesWithFilter(Request $request)
    {
        $responseGetServicesWithFilter = $this->ServiceService->getServicesWithFilter($request->all());
        return $this->successResponse($responseGetServicesWithFilter);
    }


}
