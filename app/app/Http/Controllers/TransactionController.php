<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Services\Transactions\StoreTransactionService;
use App\Http\Responses\StoreTransactionResponse;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request)
    {
        try {
            
            $storeTransactionService = (new StoreTransactionService($request));

            if($storeTransactionService->isReadyToStore){
                return response()->json(
                    new StoreTransactionResponse(
                        Response::HTTP_CREATED,
                        $storeTransactionService->storedTransactionId, 
                        Response::$statusTexts[Response::HTTP_CREATED]
                    ),
                    Response::HTTP_CREATED
                );
            }

            return response()->json(
                new StoreTransactionResponse(
                    Response::HTTP_PAYMENT_REQUIRED,
                    [ 'balance' => 'balance is not enough to withdraw money' ],
                    Response::$statusTexts[Response::HTTP_PAYMENT_REQUIRED]
                ),
                Response::HTTP_PAYMENT_REQUIRED
            );

                

        } catch (\Throwable $e) {
            throw new HttpResponseException(
                response()->json(
                    new StoreTransactionResponse(
                        Response::HTTP_INTERNAL_SERVER_ERROR,
                        response()->array($e->getMessage()),
                        Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]
                    ), 
                    Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );   
        }
    }
}