<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CashTransactionRepository extends Controller
{
    private $model, $students, $startOfWeek, $endOfWeek;

    public function __construct(CashTransaction $model, Student $students)
    {
        $this->model = $model;
        $this->students = $students;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

    /**
     * Ambil seluruh data paling terbaru pada tabel cash_transactions pada database.
     * 
     * Jika $limit === null maka tampilkan seluruh data cash_transactions tanpa limit.
     * Jika $limit !== null maka tampilkan seluruh data cash_transactions dengan limit.
     *
     * @param array $columns kolom apa saja yang ingin difetch.
     * @param int $limit limit data yang ingin ditampilkan.
     * @return Object
     */
    public function cashTransactionLatest(array $columns, ?int $limit): Object
    {
        $model = $this->model->with('students', 'users')->select($columns);

        return is_null($limit)
            ? $model->latest()->get()
            : $model->take($limit)->latest()->get();
    }

    /**
     * Hitung total kolom amount di tabel cash_transactions berdasarkan tahun atau bulan.
     * 
     * Jika $status === `year` dan variabel $year ada isinya, maka hitung total kolom amount di tabel cash_transaction berdasarkan
     * tahun sesuai di parameter.
     * 
     * Jika $status === `month` dan variabel $month ada isinya, maka hitung total kolom amount di tabel cash_transaction berdasarkan bulan
     * sesuai di parameter.
     *
     * Jika $status === `year` maka hanya isi parameter $year.
     * jika $status === `month` maka hanya isi parameter $month.
     * 
     * @param string $status ingin hitung total kolom berdasarkan tahun `year` atau bulan `month`.
     * @param string $year adalah tahun, contoh : 2021, 2022, 2023, dst..
     * @param string $month adalah bulan dengan 0, contoh : 01, 02, 03, dst..
     * @return Int
     */
    public function sumAmountBy(string $status, string $year = null, string $month = null): Int
    {
        $model = $this->model->select('date', 'amount');

        return $status === 'year'
            ? $model->whereYear('date', $year)->sum('amount')
            : $model->whereYear('date', date('Y'))->whereMonth('date', $month)->sum('amount');
    }

    /**
     * Hitung siswa yang sudah atau belum membayar pada minggu ini.
     * 
     * Jika $status === true, maka hitung berapa siswa yang sudah membayar pada minggu ini.
     * Jika $status === false, maka hitung berapa siswa yang belum membayar pada minggu ini.
     *
     * @param boolean $status
     * @return Int
     */
    public function countStudentWhoPaidOrNotPaidThisWeek(bool $status): Int
    {
        $students = $this->students->select('id');

        $callback = fn (Builder $query) => $query->select(['date'])
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);

        return $status
            ?  $students->whereHas('cash_transactions', $callback)->count()
            : $students->whereDoesntHave('cash_transactions', $callback)->count();
    }

    /**
     * Ambil data siswa yang belum membayar uang kas pada minggu ini.
     *
     * Jika limit === null maka tampilkan seluruh data siswa yang belum membayar minggu ini.
     * Jika limit !== null maka tampilkan data siswa yang belum membayar minggu ini dengan limit.
     * 
     * @param int $limit limit data yang akan ditampilkan.
     * @param string $order urutkan data berdasarkan kolom/field di database.
     * @return Object
     */
    public function getStudentWhoNotPaidThisWeek(?int $limit, string $order): Object
    {
        $students = $this->students->select(['name', 'student_identification_number'])->orderBy($order);

        $callback = fn (Builder $query) => $query->select(['date'])
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);

        return is_null($limit)
            ? $students->whereDoesntHave('cash_transactions', $callback)->get()
            : $students->whereDoesntHave('cash_transactions', $callback)->limit($limit)->get();
    }

    /**
     * Mengembalikan seluruh data yang dibutuhkan
     *
     * @return array
     */
    public function results(): array
    {
        return [
            'students' => [
                'notPaidThisWeek' => $this->getStudentWhoNotPaidThisWeek(limit: null, order: 'name'),
                'notPaidThisWeekLimit' => $this->getStudentWhoNotPaidThisWeek(limit: 6, order: 'name'),
            ],
            'studentCountWho' => [
                'paidThisWeek' => $this->countStudentWhoPaidOrNotPaidThisWeek(true),
                'notPaidThisWeek' => $this->countStudentWhoPaidOrNotPaidThisWeek(false),
            ],
            'totals' => [
                'thisMonth' => indonesian_currency($this->sumAmountBy('month', month: date('m'))),
                'thisYear' => indonesian_currency($this->sumAmountBy('year', year: date('Y'))),
            ]
        ];
    }
}
