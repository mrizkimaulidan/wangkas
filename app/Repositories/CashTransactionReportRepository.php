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
     * Hitung total dari suatu kolom pada tabel table di database dengan method sum().
     *
     * --------
     * $type = 'thisDay' sum suatu kolom/field dari tabel berdasarkan hari pada hari ini.
     * $type = 'thisWeek' sum suatu kolom/field dari tabel berdasarkan minggu pada minggu ini.
     * $type = 'thisMonth' sum suatu kolom/field dari tabel berdasarkan bulan pada bulan ini.
     * $type = 'thisYear' sum suatu kolom/field dari tabel berdasarkan tahun ini.
     * -------
     *
     * @param string $column adalah kolom/field dari tabel.
     * @param string $type adalah tipe sum yang mau diambil.
     * @return Int
     */
    public function sum(string $column, string $type): Int
    {
        $model = $this->model
            ->select('date', 'amount')
            ->whereYear('date', date('Y'));

        match ($type) {
            'thisDay' => $model->whereDay('date', date('d')),
            'thisWeek' => $model->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]),
            'thisMonth' => $model->whereMonth('date', date('m')),
            'thisYear' => $model->whereYear('date', date('Y'))
        };

        return $model->sum($column);
    }
}
