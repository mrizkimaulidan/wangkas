<?php

namespace App\Http\Controllers\Export;

use App\Contracts\ExcelExportInterface;
use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Repositories\ExportRepository;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashTransactionController extends Controller implements ExcelExportInterface
{
    const FILE_NAME = 'laporan-kas';

    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $cash_transactions = CashTransaction::with('students:id,name')
            ->select('id', 'student_id', 'bill', 'amount', 'date')
            ->whereBetween('date', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->latest()
            ->get();

        $this->setExcelContent($cash_transactions, $sheet);

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
        $sheet->setCellValue('C1', 'Tagihan');
        $sheet->setCellValue('D1', 'Total Bayar');
        $sheet->setCellValue('E1', 'Tanggal');

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
    public function setExcelContent(Collection $cash_transactions, Worksheet $sheet): Worksheet
    {
        $cell = 2;
        foreach ($cash_transactions as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->students->name);
            $sheet->setCellValue('C' . $cell, $row->bill);
            $sheet->setCellValue('D' . $cell, $row->amount);
            $sheet->setCellValue('E' . $cell, date('d-m-Y', strtotime($row->date)));
            $sheet->getStyle('A1:E' . $cell)->applyFromArray(ExportRepository::setStyle());
            $cell++;
        }

        $sheet->setCellValue('C' . $cell, 'Jumlah');
        $sheet->setCellValue('D' . $cell, $cash_transactions->sum('amount'));
        $sheet->getStyle('C' . $cell)->applyFromArray(ExportRepository::setStyle());
        $sheet->getStyle('D' . $cell)->applyFromArray(ExportRepository::setStyle());
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        return $sheet;
    }
}
