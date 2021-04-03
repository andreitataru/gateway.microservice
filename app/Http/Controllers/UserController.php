<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   //para accerder a los metodos response
use App\Traits\ApiResponser;    //para acceder a los metodos del trait
use Illuminate\Http\Request;
use App\Services\UserService; //para acceder a la conexion con el service de Author

class UserController extends Controller
{
    use ApiResponser;       //para acceder a los metodos del trait

    /**
     * The service to consume the author service
     * @var UserService
     */
    public $UserService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }


    /**
     * Register User
     * @return Iluminate\Http\Response
     */
    public function register(Request $request)
    {
        $responseRegister = $this->UserService->register($request->all());
        return $this->successResponse($responseRegister);
    }

    /**
     * Login user
     * @return Iluminate\Http\Response
     */
    public function login(Request $request)
    {
        $responseLogin = $this->UserService->login($request->all());
        return $this->successResponse($responseLogin);
    }


    /**
     * Get user profile by token
     * @return Iluminate\Http\Response
     */
    public function profile(Request $request)
    {
        $responseProfile = $this->UserService->profile($request, $request->header());
        return $this->successResponse($responseProfile);
    }

    /**
     * Check Token
     * @return Iluminate\Http\Response
     */
    public function checkToken(Request $request)
    {
        $responsecheckToken = $this->UserService->checkToken($request, $request->header());
        return $this->successResponse($responsecheckToken);
    }

    /**
     * Get Single user
     * @return Iluminate\Http\Response
     */
    public function singleUser($id)
    {
        $responseSingleUser = $this->UserService->singleUser($request, $request->header(), $id);
        return $this->successResponse($responseSingleUser);
    }

    /**
     * Get All Users
     * @return Iluminate\Http\Response
     */
    public function users(Request $request)
    {
        $responsecheckToken = $this->UserService->users($request, $request->header());
        return $this->successResponse($responsecheckToken);
    }


        /**
     * Update user
     * @return Iluminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        $token = $request->header('Authorization');
        $responseUpdateUser = $this->UserService->updateUser($request->all(), $token);
        return $this->successResponse($responseUpdateUser);
    }




}
