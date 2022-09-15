<?php

namespace App\Http\Controllers\Export;

use App\Contracts\ExcelExportInterface;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\ExportRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdministratorController extends Controller implements ExcelExportInterface
{
    const FILE_NAME = 'laporan-administrator-aplikasi';

    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setExcelHeader($spreadsheet);

        $administrators = User::select('name', 'email', 'created_at')->orderBy('name')->get();

        $this->setExcelContent($administrators, $sheet);

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
     * @param \Illuminate\Database\Eloquent\Collection adalah data yang didapat dari eloquent/query builder.
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet adalah instansiasi dari class Spreadsheet phpoffice.
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public function setExcelContent(Collection $administrators, Worksheet $sheet): Worksheet
    {
        $cell = 2;
        foreach ($administrators as $key => $row) {
            $sheet->setCellValue('A' . $cell, $key + 1);
            $sheet->setCellValue('B' . $cell, $row->name);
            $sheet->setCellValue('C' . $cell, $row->email);
            $sheet->setCellValue('D' . $cell, date('d-m-Y H:i:s', strtotime($row->created_at)));
            $cell++;
            $sheet->getStyle('A1:D' . ($cell - 1))->applyFromArray(ExportRepository::setStyle());
        }

        return $sheet;
    }
}
