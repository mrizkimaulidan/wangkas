<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdministratorsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Alamat Email',
            'Tanggal Ditambahkan',
        ];
    }

    public function map($administrator): array
    {
        static $i = 1;

        return [
            $i++,
            $administrator->name,
            $administrator->email,
            $administrator->created_at->locale('id_ID')->translatedFormat('l, d-m-Y'),
        ];
    }
}
