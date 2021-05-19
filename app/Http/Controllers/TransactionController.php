<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;   
use App\Traits\ApiResponser;    
use Illuminate\Http\Request;
use App\Services\TransactionService; 


class TransactionController extends Controller
{
    use ApiResponser;       

    /**
     * Transaction's service
     * @var TransactionService
     */
    public $TransactionService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionService $TransactionService)
    {
        $this->TransactionService = $TransactionService;
    }

    /**
     * Add Transaction
     * @return Iluminate\Http\Response
     */
    public function addTransaction(Request $request)
    {
        $responseAddTransaction = $this->TransactionService->addTransaction($request->all());
        return $this->successResponse($responseAddTransaction);
    }

    
}
