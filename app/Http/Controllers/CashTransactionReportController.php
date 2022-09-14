<?php

namespace App\Http\Controllers;

use App\Repositories\CashTransactionReportRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CashTransactionReportController extends Controller
{
    public function __construct(
        private  CashTransactionReportRepository $cashTransactionReportRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(): View|RedirectResponse
    {
        $filteredResult = [];
        $startDate = request()->get('start_date');
        $endDate = request()->get('end_date');

        if (request()->has('start_date') && request()->has('end_date')) {
            if ($startDate === null && $endDate === null) {
                return redirect()->back()->with('warning', 'Tanggal awal atau tanggal akhir tidak boleh kosong!');
            }

            $filteredResult = $this->cashTransactionReportRepository->filterByDateStartAndEnd($startDate, $endDate);
        }

        $sum = [
            'thisDay' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisDay')),
            'thisWeek' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisWeek')),
            'thisMonth' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisMonth')),
            'thisYear' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisYear')),
        ];

        return view('reports.index', [
            'sum' => $sum,
            'filteredResult' => $filteredResult
        ]);
    }
}
