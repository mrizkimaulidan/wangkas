<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class CashTransactionReportRepository extends Controller
{
    public function __construct(
        private CashTransaction $model
    ) {
    }

    /**
     * Hitung total dari suatu kolom pada tabel table di database.
     * 
     * --------
     * $type = 'this_day' sum suatu kolom/field dari tabel berdasarkan hari pada hari ini.
     * $type = 'this_week' sum suatu kolom/field dari tabel berdasarkan minggu pada minggu ini.
     * $type = 'this_month' sum suatu kolom/field dari tabel berdasarkan bulan pada bulan ini.
     * $type = 'this_year' sum suatu kolom/field dari tabel berdasarkan tahun ini.
     * -------
     * 
     * @param string $column adalah kolom/field dari tabel.
     * @param string $type adalah tipe sum yang mau diambil.
     * @return string
     */
    public function sum(string $column, string $type): string
    {
        $model = $this->model
            ->select('date', 'amount')
            ->whereYear('date', date('Y'));

        switch ($type) {
            case 'this_day':
                $model->whereDay('date', date('d'));
                break;
            case 'this_week':
                $model->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'this_month':
                $model->whereMonth('date', date('m'));
                break;
            case 'this_year':
                $model->whereYear('date', date('Y'));
                break;
        }

        return $model->sum($column);
    }

    /**
     * Filter data kas pada tabel dengan rentang tanggal.
     *
     * @return void
     */
    public function filter()
    {
        if ($_GET) {
            $startDate = date('Y-m-d', strtotime($_GET['start_date']));
            $endDate = date('Y-m-d', strtotime($_GET['end_date']));

            $filtered_data = $this->model
                ->select('user_id', 'student_id', 'amount', 'date')
                ->with('students:id,name', 'users:id,name')
                ->whereBetween('date', [$startDate, $endDate])
                ->orderBy('date')
                ->get();

            $result = [
                'filtered_data' => $filtered_data ?? null,
                'total_amount' => [
                    'is_paid' => $filtered_data->sum('amount') ?? null,
                    'is_not_paid' => $filtered_data->sum('amount') ?? null
                ]
            ];
        }

        return $result ?? null;
    }
}
