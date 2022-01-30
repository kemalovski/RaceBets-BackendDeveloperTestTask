<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function save(StoreCustomerRequest $request){
        
        DB::table('customers')->insert(
            [
                'gender' => $request['gender'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'country' => $request['country'],
                'email' => $request['email'],
            ]
        );

    }
}
