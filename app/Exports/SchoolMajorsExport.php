<?php

namespace App\Exports;

use App\Models\SchoolMajor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SchoolMajorsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SchoolMajor::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Jurusan',
            'Singkatan Jurusan',
        ];
    }

    public function map($schoolMajor): array
    {
        static $i = 1;

        return [
            $i++,
            $schoolMajor->name,
            $schoolMajor->abbreviation,
        ];
    }
}
