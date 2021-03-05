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
    public function export(string $start_date, string $end_date)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Pelajar');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Nominal Bayar');
        $sheet->setCellValue('F1', 'Pencatat');
        $sheet->getColumnDimension('A')->setAutoSize(true);

        $cash_transaction_results = CashTransaction::with('students', 'users')->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))])->orderBy('student_id')->get();
        $cell = 2;

        $style_array = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];

        foreach ($cash_transaction_results as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->students->name);
            $sheet->setCellValue('C' . $cell, $row->date);
            $sheet->setCellValue('D' . $cell, $row->is_paid);
            $sheet->setCellValue('E' . $cell, $row->amount);
            $sheet->setCellValue('F' . $cell, $row->users->name);
            $cell++;
            $sheet->getStyle('A1:F' . $cell - 1)->applyFromArray($style_array);
        }

        $writer = new Xlsx($spreadsheet);
        $file_name = 'laporan-kas-' . $start_date . '_' . $end_date . '_' . date('His');

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $file_name . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}
