<?php

namespace App\Http\Services\Transactions;

use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\DB;

class StoreTransactionService
{
    public $storedTransactionId = [];
    public $request;
    private $bonusAmount = 0;
    public $isReadyToStore;
    use DepositService;
    use WithdrawService;

    public function __construct(StoreTransactionRequest $request)
    {
        $this->request = $request;
        $this->isReadyToStore = $this->request['real_amount'] > 0 ?
            $this->setBonusAmount() :
            $this->isWithdrawable();

        return $this->isReadyToStore ? $this->storeTransaction() : false;
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
