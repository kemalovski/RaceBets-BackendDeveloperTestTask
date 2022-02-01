<?php

namespace App\Http\Services\Customers;

use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\DB;

class UpdateCustomerService
{
    public $customerId;
    public $request;
    public $updatedCustomerId;

    public function __construct(UpdateCustomerRequest $request, int $customerId)
    {
        $this->request = $request;
        $this->customerId = $customerId;
    }

    public function updateCustomer(){
        
        $updated = DB::table("customers")
            ->where('id', $this->customerId)
            ->update(
                [
                    'gender' => $this->request['gender'],
                    'first_name' => $this->request['first_name'],
                    'last_name' => $this->request['last_name'],
                    'country' => $this->request['country'],
                    'email' => $this->request['email'],
                ]);
        
        $this->updatedCustomerId = $updated ? 
                 ['id' => $this->customerId] : ['id' => $updated];
        return $this;

    }
}
