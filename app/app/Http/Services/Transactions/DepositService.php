<?php

namespace App\Http\Services\Transactions;

use Illuminate\Support\Facades\DB;

trait DepositService
{

    public function setBonusAmount(){
        
        $countOfDeposit = DB::table("transactions")
            ->selectRaw('count(id) as countOfDeposit')
            ->where('customer_id', $this->request['customer_id'])
            ->groupBy('customer_id')->first();
            
        $bonusValue = DB::table("bonuses")
            ->selectRaw('bonus_value')
            ->where('customer_id', $this->request['customer_id'])->first();
            
        if (isset($countOfDeposit->countOfDeposit) && $countOfDeposit->countOfDeposit % 3 == 2) {
            $this->bonusAmount = ($bonusValue->bonus_value * $this->request['real_amount']) / 100;
        }

        return true;
        
    }
    
}
