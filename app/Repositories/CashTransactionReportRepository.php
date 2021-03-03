<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Carbon\Carbon;

class CashTransactionReportRepository extends Controller
{
    public function __construct(
        private CashTransaction $model
    ) {
    }

    /**
     * Hitung total dari suatu kolom pada tabel cash_transactions pada database.
     * 
     * --------
     * $type = 'this_day' sum suatu kolom/field dari tabel berdasarkan hari pada tahun ini.
     * $type = 'this_week' sum suatu kolom/field dari tabel berdasarkan minggu pada tahun ini.
     * $type = 'this_month' sum suatu kolom/field dari tabel berdasarkan bulan pada tahun ini.
     * $type = 'this_year' sum suatu kolom/field dari tabel berdasarkan tahun ini.
     * -------
     * 
     * @param string $column adalah kolom/field dari tabel.
     * @param string $type adalah tipe sum yang mau diambil.
     * @return string
     */
    public function sumAmount(string $column, string $type): string
    {
        $model = $this->model->where('is_paid', 1)->whereYear('date', date('Y'));

        if ($type === 'this_day')
            $model->whereDay('date', date('d'));

        if ($type === 'this_week')
            $model->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

        if ($type === 'this_month')
            $model->whereMonth('date', date('m'));

        if ($type === 'this_year')
            $model->whereYear('date', date('Y'));

        return $model->sum($column);
    }

    public function filter()
    {
        if ($_GET) {
            $filtered_data = $this->model->with('students', 'users')->whereBetween('date', [$_GET['start_date'], $_GET['end_date']])->orderBy('date')->get();

            $result = [
                'filtered_data' => $filtered_data ?? [],
                'total_amount' => [
                    'is_paid' => $filtered_data->where('is_paid', 1)->sum('amount') ?? null,
                    'is_not_paid' => $filtered_data->where('is_paid', 0)->sum('amount') ?? null
                ]
            ];
        }

        return $result ?? [];
    }
}
