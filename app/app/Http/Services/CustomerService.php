<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\StoreCustomerResponse;
use Symfony\Component\HttpFoundation\Response;
class CustomerService
{
    public function save(StoreCustomerRequest $request){
        try {
            $stored = DB::table("customers")->insertGetId(
                [
                    'gender' => $request['gender'],
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'country' => $request['country'],
                    'email' => $request['email'],
                ]);
                
            return ['id' => $stored];
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
}
