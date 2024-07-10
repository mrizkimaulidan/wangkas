<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::with('schoolClass:id,name', 'schoolMajor:id,name')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS/NISN/NIM',
            'Nama Mahasiswa',
            'Jurusan',
            'Kelas',
            'Jenis Kelamin',
            'Alamat Email',
            'Nomor Handphone',
            'Tahun Ajaran Awal dan Akhir',
        ];
    }

    public function map($student): array
    {
        static $i = 1;

        return [
            $i++,
            $student->student_identification_number,
            $student->name,
            $student->schoolMajor->name,
            $student->schoolClass->name,
            $student->getGenderName(),
            $student->email,
            $student->phone_number,
            $student->school_year_start . ' - ' . $student->school_year_end,
        ];
    }
}
