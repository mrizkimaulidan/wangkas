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
     * Generate nama file.
     *
     * @param string $file_name
     * @return string
     */
    public static function generateFileName(string $file_name): string
    {
        return $file_name . date('dmY_His');
    }

    /**
     * Menampilkan pesan dialog download excel.
     *
     * @param object $spreadsheet
     * @return void
     */
    public static function outputTheExcel(object $spreadsheet, string $file_name)
    {
        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . self::generateFileName($file_name) . '".xlsx');
        $writer->save('php://output');
        exit();
    }
}
