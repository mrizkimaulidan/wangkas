<?php

namespace App\Exports;

use App\Models\SchoolClass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SchoolClassesExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SchoolClass::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kelas',
        ];
    }

    public function map($schoolClass): array
    {
        static $i = 1;

        return [
            $i++,
            $schoolClass->name,
        ];
    }
}
