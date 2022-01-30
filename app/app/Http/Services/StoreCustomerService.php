<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\DB;

class StoreCustomerService
{
    public $storedCustomerId;
    public $request;

    public function __construct(StoreCustomerRequest $request)
    {
        $this->request = $request;
    }

    public function assigned_random_bonus_customer(){
        DB::table("bonuses")->insertGetId(
            [
                'customer_id' => $this->storedCustomerId['id'],
                'bonus_value'=> rand(5,20),
            ]);

        return $this;
            
    }

    public function storeCustomer(){
            $storedId = DB::table("customers")->insertGetId(
                [
                    'gender' => $this->request['gender'],
                    'first_name' => $this->request['first_name'],
                    'last_name' => $this->request['last_name'],
                    'country' => $this->request['country'],
                    'email' => $this->request['email'],
                ]);
                
            $this->storedCustomerId = ['id' => $storedId];
            
            return $this;

    }
}
