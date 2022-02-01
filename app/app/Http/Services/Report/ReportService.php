<?php

namespace App\Http\Services\Report;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportService
{
    public function getReport(){
        return DB::table('customers')
            ->leftJoin('transactions', 'customers.id', '=', 'transactions.customer_id')
            ->where('transactions.created_at', '>=', json_encode(Carbon::now()->subDays(7)->format('Y-m-d')) )
            ->groupBy('customers.country')
            ->select(
                Db::raw('DATE_FORMAT(max(transactions.created_at),\'%Y/%m/%d\') as date'),
                'customers.country as country',
                Db::raw('count(DISTINCT transactions.`customer_id`) as uniqueCustomers'),
                Db::raw('count(CASE WHEN transactions.`real_amount` > 0 THEN 1 END) as noOfDeposits'),
                Db::raw('sum(CASE WHEN transactions.`real_amount` > 0 THEN transactions.`real_amount` END) as totalDepositAmount'),
                Db::raw('count(CASE WHEN transactions.`real_amount` < 0 THEN 1 END) as noOfWithdrawals'),
                Db::raw('sum(CASE WHEN transactions.`real_amount` < 0 THEN transactions.`real_amount` END) as totalWithdrawalAmount')
            )
            ->get();
    }
    
}
