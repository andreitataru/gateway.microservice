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
     * Get Messages
     * @return Iluminate\Http\Response
     */
    public function getAllHouses()
    {
        $responseGetAllHouses = $this->HouseService->getAllHouses();
        return $this->successResponse($responseGetAllHouses);
    }

    /**
     * Get Active Chats
     * @return Iluminate\Http\Response
     */
    public function getHouseById($id)
    {
        $responseGetHouseById = $this->HouseService->getHouseById($id);
        return $this->successResponse($responseGetHouseById);
    }

    /**
     * Add House
     * @return Iluminate\Http\Response
     */
    public function updateHouse(Request $request)
    {
        $responseUpdateHouse = $this->HouseService->updateHouse($request->all());
        return $this->successResponse($responseUpdateHouse);
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
    public function deleteHouseById($id)
    {
        $responseDeleteHouseById = $this->HouseService->deleteHouseById($id);
        return $this->successResponse($responseDeleteHouseById);
    }


    /**
     * Add House
     * @return Iluminate\Http\Response
     */
    public function getHousesWithFilter(Request $request)
    {
        $responseGetHousesWithFilter = $this->HouseService->getHousesWithFilter($request->all());
        return $this->successResponse($responseGetHousesWithFilter);
    }




}
