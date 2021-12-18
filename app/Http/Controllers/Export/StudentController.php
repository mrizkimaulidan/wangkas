<?php

namespace App\Http\Controllers\Export;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Repositories\ExportRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class StudentController extends Controller
{
    const FILE_NAME = 'laporan-siswa';

    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $this->setHeaderExcel($spreadsheet);

        $students = Student::with('school_classes:id,name', 'school_majors:id,name')->orderBy('name')->get();

        $this->setExcelContent($students, $sheet);

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
        $sheet->setCellValue('B1', 'NIS/NISN');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Kelas');
        $sheet->setCellValue('F1', 'Jurusan');
        $sheet->setCellValue('G1', 'Tahun Ajaran');

        foreach (range('A', 'G') as $paragraph) {
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
            $sheet->setCellValue('B' . $cell, $row->student_identification_number);
            $sheet->setCellValue('C' . $cell, $row->name);
            $sheet->setCellValue('D' . $cell, $row->gender === 1 ? 'Laki-laki' : 'Perempuan');
            $sheet->setCellValue('E' . $cell, $row->school_class->name);
            $sheet->setCellValue('F' . $cell, $row->school_major->name);
            $sheet->setCellValue('G' . $cell, $row->school_year_start . ' - ' . $row->school_year_end);
            $cell++;
            $sheet->getStyle('A1:G' . ($cell - 1))->applyFromArray(ExportRepository::setStyle());
        }

        return $sheet;
    }
}
