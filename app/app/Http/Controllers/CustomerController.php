<?php

namespace App\Http\Controllers;

use App\Http\Services\StoreCustomerService;
use App\Http\Responses\StoreCustomerResponse;
use App\Http\Requests\StoreCustomerRequest;

use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Services\UpdateCustomerService;
use App\Http\Responses\UpdateCustomerResponse;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            $storeCustomerService = (new StoreCustomerService($request))
                ->storeCustomer()
                ->assigned_random_bonus_customer();

                return response()->json(
                    new StoreCustomerResponse(
                        Response::HTTP_CREATED,
                        $storeCustomerService->storedCustomerId, 
                        Response::$statusTexts[Response::HTTP_CREATED]
                    ),
                    Response::HTTP_CREATED
                );

        } catch (\Throwable $e) {
            throw new HttpResponseException(
                response()->json(
                    new StoreCustomerResponse(
                        Response::HTTP_INTERNAL_SERVER_ERROR,
                        response()->array($e->getMessage()),
                        Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]
                    ), 
                    Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );   
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $customerId)
    {

        try {
            
            $updateCustomerService = (new UpdateCustomerService($request, $customerId))
                ->updateCustomer();

            $httpStatus = $updateCustomerService->updatedCustomerId['id'] ? 
            Response::HTTP_OK : 
            Response::HTTP_NO_CONTENT;

            return response()->json(
                new UpdateCustomerResponse(
                    $httpStatus,
                    $updateCustomerService->updatedCustomerId, 
                    Response::$statusTexts[$httpStatus]
                ),
                Response::HTTP_OK
            );

        } catch (\Throwable $e) {

            throw new HttpResponseException(
                response()->json(
                    new UpdateCustomerResponse(
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
