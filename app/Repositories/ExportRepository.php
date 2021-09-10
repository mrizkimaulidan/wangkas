<?php

namespace App\Repositories;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportRepository
{
    /**
     * Kustomisasi untuk style excelnya.
     *
     * @return array
     */
    public static function setStyle(): array
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
     * Menampilkan pesan dialog download excel.
     *
     * @param object $spreadsheet
     * @param string $file_name
     * @return void
     */
    public static function outputTheExcel(object $spreadsheet, string $file_name)
    {
        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $file_name . date('dmY_His') . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}
