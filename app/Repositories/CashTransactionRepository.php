<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class CashTransactionRepository extends Controller
{
    public function __construct(
        private CashTransaction $model
    ) {
    }

    public function cashTransactionLatest()
    {
        return $this->model->latest()->get();
    }
}
