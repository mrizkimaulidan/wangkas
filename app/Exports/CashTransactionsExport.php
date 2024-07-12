<?php

namespace App\Exports;

use App\Models\CashTransaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CashTransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(
        public string $startDate,
        public string $endDate
    ) {
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return CashTransaction::query()->whereBetween('date_paid', [$this->startDate, $this->endDate])
            ->with(
                'student:id,school_major_id,school_class_id,student_identification_number,name',
                'student.schoolMajor:id,name',
                'student.schoolClass:id,name',
                'createdBy:id,name'
            )->orderBy('date_paid');
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS/NISN/NIM',
            'Nama Mahasiswa',
            'Jurusan',
            'Kelas',
            'Total Bayar',
            'Tanggal Bayar',
            'Catatan',
            'Dicatat Oleh'
        ];
    }

    public function map($cashTransaction): array
    {
        static $i = 1;

        return [
            $i++,
            $cashTransaction->student->student_identification_number,
            $cashTransaction->student->name,
            $cashTransaction->student->schoolMajor->name,
            $cashTransaction->student->schoolClass->name,
            $cashTransaction->amount,
            $cashTransaction->date_paid_formatted,
            $cashTransaction->transaction_note,
            $cashTransaction->createdBy->name,
        ];
    }
}
