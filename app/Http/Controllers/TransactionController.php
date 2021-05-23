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

    /**
     * Get Transactions
     * @return Iluminate\Http\Response
     */
    public function getAllTransactions()
    {
        $responseGetAllTransactions = $this->TransactionService->getAllTransactions();
        return $this->successResponse($responseGetAllTransactions);
    }

    /**
     * Get transaction by id
     * @return Iluminate\Http\Response
     */
    public function getTransactionById($id)
    {
        $responseGetTransactionById = $this->TransactionService->getTransactionById($id);
        return $this->successResponse($responseGetTransactionById);
    }

    /**
     * Get transaction by UserId
     * @return Iluminate\Http\Response
     */
    public function getTransactionByUserId($id)
    {
        $responseGetTransactionByUserId = $this->TransactionService->getTransactionByUserId($id);
        return $this->successResponse($responseGetTransactionByUserId);
    }

    /**
     * Get Transactions by date
     * @return Iluminate\Http\Response
     */
    public function getTransactionsByDate(Request $request)
    {
        $responseGetTransactionsByDate = $this->TransactionService->getTransactionsByDate($request->all());
        return $this->successResponse($responseGetTransactionsByDate);
    }

    
}
