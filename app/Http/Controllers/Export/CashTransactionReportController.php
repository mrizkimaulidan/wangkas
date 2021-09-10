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
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Nominal Bayar');
        $sheet->setCellValue('F1', 'Pencatat');

        foreach (range('A', 'F') as $paragraph) {
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
            $sheet->setCellValue('D' . $cell, paid_status($row->is_paid));
            $sheet->setCellValue('E' . $cell, indonesian_currency($row->amount));
            $sheet->setCellValue('F' . $cell, $row->users->name);
            $cell++;
            $sheet->getStyle('A1:F' . ($cell - 1))->applyFromArray($style);

            $sheet->setCellValue('D' . $cell, 'Total Lunas')->getStyle('D' . $cell)->applyFromArray($style);
            $sheet->setCellValue('D' . ($cell + 1), 'Total Belum Lunas')->getStyle('D' . ($cell + 1))->applyFromArray($style);

            $sheet->setCellValue('E' . $cell, indonesian_currency($cash_transaction_results->where('is_paid', 1)->sum('amount')))->getStyle('E' . $cell)->applyFromArray($style);;
            $sheet->setCellValue('E' . ($cell + 1), indonesian_currency($cash_transaction_results->where('is_paid', 0)->sum('amount')))->getStyle('E' . ($cell + 1))->applyFromArray($style);;
        }

        return $sheet;
    }
}
