<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class DashboardChartRepository extends Controller
{
    public function __construct(
        private CashTransaction $model,
    ) {
    }

    /**
     * Hitung seluruh kolom amount pada tabel cash_transactions dipisahkan dengan bulan dari 1-12.
     *
     * @return array
     */
    public function sumCashTransactionPerMonths(): array
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        for ($i = 1; $i <= 12; $i++) {
            $cash_transactions = $this->model->where('is_paid', 1)->whereYear('date', date('Y'))->whereMonth('date', "{$i}")->sum('amount');

            $data[$months[$i - 1]] = $cash_transactions;
        }

        /**
         * $data = [
         *  'jan' => 10000,
         *  'feb' => 10000,
         *  'mar' => 10000,
         *  'apr' => 10000,
         *  'mei' => 10000,
         *  'jun' => 10000,
         *  'jul' => 10000,
         *  'agu' => 10000,
         *  'sep' => 10000,
         *  'okt' => 10000,
         *  'nov' => 10000,
         *  'des'
         * ];
         */

        return $data;
    }
}
