<?php

namespace App\Http\Services\Transactions;

use Illuminate\Support\Facades\DB;

trait WithdrawService
{

    public function isWithdrawable(){
        
        $balance = DB::table("transactions")
            ->selectRaw('sum(real_amount) as balance')
            ->where('customer_id', $this->request['customer_id'])
            ->groupBy('customer_id')->first();

        if (abs($this->request['real_amount']) > $balance->balance) {
            return false;
        }
        return true;
    }
    
}
