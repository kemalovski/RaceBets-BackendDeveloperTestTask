<?php

namespace App\Http\Services;

use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\DB;

abstract class StoreTransactionService
{
    public $storedTransactionId;
    public $request;
    private $bonusAmount = 0;

    public function __construct(StoreTransactionRequest $request)
    {
        $this->request = $request;
        $this->setBonusAmount();
    }

    private function setBonusAmount(){
        $countOfDeposit = DB::table("transactions")
            ->selectRaw('count(id) as countOfDeposit')
            ->where('customer_id', $this->request['customer_id'])
            ->groupBy('customer_id')->first();
        
        $bonusValue = DB::table("bonuses")
            ->selectRaw('bonus_value')
            ->where('customer_id', $this->request['customer_id'])->first();
        
        if ($countOfDeposit->countOfDeposit % 3 == 0) {
            $this->bonusAmount = ($bonusValue->bonus_value * $this->request['real_amount']) / 100;
        }
        
    }

    public function storeTransaction(){
        $storedId = DB::table("transactions")->insertGetId(
            [
                'real_amount' => $this->request['real_amount'],
                'customer_id' => $this->request['customer_id'],
                'bonus_amount' => $this->bonusAmount,
            ]);
            
        $this->storedTransactionId = ['id' => $storedId];
        
        return $this;
    }

}
