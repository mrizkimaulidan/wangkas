<?php

namespace App\Http\Controllers\Export;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CashTransactionController extends Controller
{
    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $students = CashTransaction::orderBy('date')->get();

        $this->setExcelContent($students, $sheet);

        $this->outputTheExcel($spreadsheet);
    }

    /**
     * Generate nama file.
     *
     * @return string
     */
    public function generateFileName(): string
    {
        return 'laporan-kas-' . date('d-m-Y') . '_' . date('His');
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
        $sheet->setCellValue('C1', 'Tagihan');
        $sheet->setCellValue('D1', 'Total Bayar');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'Status');

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
    public function setExcelContent(object $students, object $sheet): object
    {
        $cell = 2;
        foreach ($students as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->students->name);
            $sheet->setCellValue('C' . $cell, $row->bill);
            $sheet->setCellValue('D' . $cell, $row->amount);
            $sheet->setCellValue('E' . $cell,  date('d-m-Y', strtotime($row->date)));
            $sheet->setCellValue('F' . $cell, paid_status($row->is_paid));
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
    public function outputTheExcel(object $spreadsheet)
    {
        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $this->generateFileName() . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}
