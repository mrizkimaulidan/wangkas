<?php

namespace App\Http\Controllers\Export;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AdministratorController extends Controller
{
    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $administrators = User::orderBy('name')->get();

        $this->setExcelContent($administrators, $sheet);

        $this->outputTheExcel($spreadsheet);
    }

    /**
     * Generate nama file.
     *
     * @return string
     */
    public function generateFileName(): string
    {
        return 'laporan-administrator-aplikasi-' . date('d-m-Y') . '_' . date('His');
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
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Tanggal Ditambahkan');

        foreach (range('A', 'D') as $paragraph) {
            $sheet->getColumnDimension($paragraph)->setAutoSize(true);
        }

        return $sheet;
    }

    /**
     * Mengisi konten untuk excel.
     *
     * @param object $administrators adalah list administrator yang didapat dari eloquent/query builder.
     * @param object $sheet adalah instansiasi dari class Spreadsheet phpoffice.
     * @return object
     */
    public function setExcelContent(object $administrators, object $sheet): object
    {
        $cell = 2;
        foreach ($administrators as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->name);
            $sheet->setCellValue('C' . $cell, $row->email);
            $sheet->setCellValue('D' . $cell, date('d-m-Y H:i:s', strtotime($row->created_at)));
            $cell++;
            $sheet->getStyle('A1:D' . $cell - 1)->applyFromArray($this->setStyle());
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
