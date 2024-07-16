<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionExportRequest;
use App\Http\Requests\CashTransactionFilterRequest;
use App\Services\CashTransactionService;
use Illuminate\Http\Request;

class CashTransactionExportController extends Controller
{
    public function __construct(
        private CashTransactionService $cashTransactionService
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\CashTransactionExportRequest
     */
    public function __invoke(CashTransactionExportRequest $request)
    {
        $validated = $request->validated();

        $startDate = now()->createFromDate($validated['start_date']);
        $endDate = now()->createFromDate($validated['end_date']);

        return $this->cashTransactionService->export($startDate, $endDate);
    }
}
