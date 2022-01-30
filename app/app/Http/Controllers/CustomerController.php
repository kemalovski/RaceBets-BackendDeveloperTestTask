<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Services\StoreCustomerService;
use App\Http\Responses\StoreCustomerResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
