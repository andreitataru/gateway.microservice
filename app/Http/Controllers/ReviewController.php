<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\ReviewService; 
use App\Services\UserService;

class ReviewController extends Controller
{
    use ApiResponser;       

    /**
     * User's service
     * @var UserService
     */
    public $UserService;

    /**
     * Review's service
     * @var ReviewService
     */
    public $ReviewService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService, ReviewService $ReviewService)
    {
        $this->ReviewService = $ReviewService;
        $this->UserService = $UserService;
    }


    /**
     * Add Service
     * @return Iluminate\Http\Response
     */
    public function addReview(Request $request)
    {
        $token = $request->header('Authorization');
        $responsecheckToken = $this->UserService->checkToken($request, $token);
        
        $obj = json_decode($responsecheckToken, true);

        if ($obj['status'] == "Token Valid" && $obj['accountId'] == $request->userIdReview){
            $responseAddReview = $this->ReviewService->addReview($request->all());
            return $this->successResponse($responseAddReview);
        }
        else {
            return $this->errorResponse("Error", 401);
        }
    }

    /**
     * Get review by id
     * @return Iluminate\Http\Response
     */
    public function getReviewById($id)
    {
        $responsGetReviewById = $this->ReviewService->getReviewById($id);
        return $this->successResponse($responsGetReviewById);
    }

        /**
     * Get review by id
     * @return Iluminate\Http\Response
     */
    public function getReviewsByTarget($id, $type)
    {
        $responsGetReviewsByTarget = $this->ReviewService->getReviewsByTarget($id, $type);
        return $this->successResponse($responsGetReviewsByTarget);
    }


}
