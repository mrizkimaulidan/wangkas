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
     * $type = 'thisDay' sum suatu kolom/field dari tabel berdasarkan hari pada hari ini.
     * $type = 'thisWeek' sum suatu kolom/field dari tabel berdasarkan minggu pada minggu ini.
     * $type = 'thisMonth' sum suatu kolom/field dari tabel berdasarkan bulan pada bulan ini.
     * $type = 'thisYear' sum suatu kolom/field dari tabel berdasarkan tahun ini.
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
            case 'thisDay':
                $model->whereDay('date', date('d'));
                break;
            case 'thisWeek':
                $model->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'thisMonth':
                $model->whereMonth('date', date('m'));
                break;
            case 'thisYear':
                $model->whereYear('date', date('Y'));
                break;
        }

        return $model->sum($column);
    }
}
