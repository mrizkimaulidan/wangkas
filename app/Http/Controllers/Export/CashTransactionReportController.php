<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Repositories\ExportRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CashTransactionReportController extends Controller
{
    const FILE_NAME = 'laporan-kas';

    public function __invoke(string $start_date, string $end_date)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $cash_transaction_results = CashTransaction::with('students', 'users')
            ->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))])
            ->orderBy('student_id')
            ->get();

        $this->setExcelContent($cash_transaction_results, $sheet);

        ExportRepository::outputTheExcel($spreadsheet, self::FILE_NAME);
    }

    /**
     * Menyiapkan isi header untuk excelnya.
     *
     * @param object $spreadsheet
     * @return object
     */
    public function setHeaderExcel(object $spreadsheet): object
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Pelajar');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nominal Bayar');
        $sheet->setCellValue('E1', 'Pencatat');

        foreach (range('A', 'E') as $paragraph) {
            $sheet->getColumnDimension($paragraph)->setAutoSize(true);
        }

        return $sheet;
    }

    /**
     * Mengisi konten untuk excel.
     *
     * @param object $students adalah list siswa yang didapat dari eloquent/query builder.
     * @param object $sheet adalah instansiasi dari class Spreadsheet phpoffice.
     * @return object
     */
    public function setExcelContent(object $cash_transaction_results, object $sheet): object
    {
        $style = ExportRepository::setStyle();

        $cell = 2;
        foreach ($cash_transaction_results as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->students->name);
            $sheet->setCellValue('C' . $cell, date('d-m-Y', strtotime($row->date)));
            $sheet->setCellValue('D' . $cell, $row->amount);
            $sheet->setCellValue('E' . $cell, $row->users->name);
            $sheet->getStyle('A1:E' . $cell)->applyFromArray($style);
            $cell++;
        }

        $sheet->setCellValue('C' . $cell, 'Total')->getStyle('C' . $cell)->applyFromArray($style);
        $sheet->setCellValue('D' . $cell, $cash_transaction_results->sum('amount'))->getStyle('D' . $cell)->applyFromArray($style);

        return $sheet;
    }
}
