<?php

namespace App\Http\Controllers\Export;

use App\Contracts\ExcelExportInterface;
use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Repositories\ExportRepository;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashTransactionReportController extends Controller implements ExcelExportInterface
{
    const FILE_NAME = 'laporan-kas';

    public function __invoke(string $start_date, string $end_date)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setExcelHeader($spreadsheet);

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
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public function setExcelHeader(Spreadsheet $spreadsheet): Worksheet
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
     * @param \Illuminate\Database\Eloquent\Collection adalah data yang didapat dari eloquent/query builder.
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet adalah instansiasi dari class Spreadsheet phpoffice.
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public function setExcelContent(Collection $cash_transaction_results, Worksheet $sheet): Worksheet
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
