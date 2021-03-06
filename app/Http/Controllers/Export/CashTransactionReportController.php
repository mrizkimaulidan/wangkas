<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CashTransactionReportController extends Controller
{
    public function __invoke(string $start_date, string $end_date)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $cash_transaction_results = CashTransaction::with('students', 'users')->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))])->orderBy('student_id')->get();

        $this->setExcelContent($cash_transaction_results, $sheet);

        $this->outputTheExcel($spreadsheet, $start_date, $end_date);
    }

    /**
     * Generate nama file.
     *
     * @return string
     */
    public function generateFileName(string $start_date, string $end_date): string
    {
        return 'laporan-kas-' . $start_date . '_' . $end_date . '_' . date('His');
    }

    /**
     * Kustomisasi untuk style excelnya.
     *
     * @return array
     */
    public function setStyle(): array
    {
        return [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];
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
        $cell = 2;
        foreach ($cash_transaction_results as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->students->name);
            $sheet->setCellValue('C' . $cell, $row->date);
            $sheet->setCellValue('D' . $cell, $row->is_paid);
            $sheet->setCellValue('E' . $cell, $row->amount);
            $sheet->setCellValue('F' . $cell, $row->users->name);
            $cell++;
            $sheet->getStyle('A1:F' . $cell - 1)->applyFromArray($this->setStyle());
        }

        return $sheet;
    }

    /**
     * Menampilkan pesan dialog download excel.
     *
     * @param object $spreadsheet
     * @return void
     */
    public function outputTheExcel(object $spreadsheet, string $start_date, string $end_date)
    {
        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->generateFileName($start_date, $end_date) . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}
