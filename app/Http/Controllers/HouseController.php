<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\HouseService; 
use App\Services\UserService;

class HouseController extends Controller
{
    use ApiResponser;       

    /**
     * Houses's service
     * @var HouseService
     */
    public $HouseService;
    /**
     * User's service
     * @var UserService
     */
    public $UserService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService, HouseService $HouseService)
    {
        $this->UserService = $UserService;
        $this->HouseService = $HouseService;
    }


    /**
     * Add House
     * @return Iluminate\Http\Response
     */
    public function addHouse(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Host"){
            $request->request->add(['hostId' => $obj['accountId']]);
            $responseAddHouse = $this->HouseService->addHouse($request->all());
            return $this->successResponse($responseAddHouse);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

    /**
     * Get Houses
     * @return Iluminate\Http\Response
     */
    public function getAllHouses()
    {
        $responseGetAllHouses = $this->HouseService->getAllHouses();
        return $this->successResponse($responseGetAllHouses);
    }

    /**
     * Get House by Id
     * @return Iluminate\Http\Response
     */
    public function getHouseById($id)
    {
        $responseGetHouseById = $this->HouseService->getHouseById($id);
        return $this->successResponse($responseGetHouseById);
    }

    /**
     * Update House
     * @return Iluminate\Http\Response
     */
    public function updateHouse(Request $request)
    {
        //validar token e tipo de conta
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        $obj = json_decode($responsecheckToken, true);

        //deixar só o dono da casa fazer alterações
        $responseGetHouseById = $this->HouseService->getHouseById($request->houseId);
        $houseObj = json_decode($responseGetHouseById, true);

        if ($obj['status'] == "Token Valid" && ($obj['accountType'] == "Host" || $obj['accountType'] == "Admin") && $obj['accountId'] == $houseObj['house']['hostId']){
            $responseUpdateHouse = $this->HouseService->updateHouse($request->all());
            return $this->successResponse($responseUpdateHouse);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
  
    }


    /**
     * Delete House by Id
     * @return Iluminate\Http\Response
     */
    public function deleteHouseById($id, Request $request)
    {
        //validar token e tipo de conta
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        $obj = json_decode($responsecheckToken, true);

        //deixar só o dono da casa apagar a casa
        $responseGetHouseById = $this->HouseService->getHouseById($id);
        $houseObj = json_decode($responseGetHouseById, true);
        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Host" && $obj['accountId'] == $houseObj['house']['hostId']){
            $responseDeleteHouseById = $this->HouseService->deleteHouseById($id);
            return $this->successResponse($responseDeleteHouseById);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }


    /**
     * Get House with filters
     * @return Iluminate\Http\Response
     */
    public function getHousesWithFilter(Request $request)
    {
        $responseGetHousesWithFilter = $this->HouseService->getHousesWithFilter($request->all());
        return $this->successResponse($responseGetHousesWithFilter);
    }

    
    /**
     * Get Houses by hostId
     * @return Iluminate\Http\Response
     */
    public function getHousesWithOwnerId($id)
    {
        $responseGetHousesWithOwnerId = $this->HouseService->getHousesWithOwnerId($id);
        return $this->successResponse($responseGetHousesWithOwnerId);
    }

    /**
     * Add Interest
     * @return Iluminate\Http\Response
     */
    public function addInterest(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid" && $obj['accountType'] == "Student"){
            $request->request->add(['idInterested' => $obj['accountId']]);
            $request->request->add(['personName' => $obj['name']]);
            $responseAddInterest = $this->HouseService->addInterest($request->all());
            return $this->successResponse($responseAddInterest);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }


    /**
     * Get interests by houseId
     * @return Iluminate\Http\Response
     */
    public function getInterestsByHouseId($id)
    {
        $responseGetInterestsByHouseId = $this->HouseService->getInterestsByHouseId($id);
        return $this->successResponse($responseGetInterestsByHouseId);
    }
    

    /**
     * Get interests by userId
     * @return Iluminate\Http\Response
     */
    public function getInterestsByUserId($id)
    {
        $responseGetInterestsByUserId = $this->HouseService->getInterestsByUserId($id);
        return $this->successResponse($responseGetInterestsByUserId);
    }

    /**
     * Rate House
     * @return Iluminate\Http\Response
     */
    public function rateHouse(Request $request)
    {
        $responseRateHouse = $this->HouseService->rateHouse($request->all());
        return $this->successResponse($responseRateHouse); 
    }
}
