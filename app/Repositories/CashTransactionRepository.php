<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CashTransactionRepository extends Controller
{
    private $model, $students, $start_of_week, $end_of_week;

    public function __construct(CashTransaction $model, Student $students)
    {
        $this->model = $model;
        $this->students = $students;
        $this->start_of_week = now()->startOfWeek()->format('Y-m-d');
        $this->end_of_week = now()->endOfWeek()->format('Y-m-d');
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

        // Jika $status === `year` dan variabel $year ada isinya, maka hitung kolom amount berdasarkan tahun di parameter.
        if (strtolower($status) === 'year' && isset($year)) {
            $model->whereYear('date', $year);
        }

        // Jika $status === `month` dan variabel $month ada isinya, maka hitung kolom amount berdasarkan bulan di parameter.
        if (strtolower($status) === 'month' && isset($month)) {
            $model->whereYear('date', date('Y'))->whereMonth('date', $month);
        }

        return $model->sum('amount');
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

        $callback = fn (Builder $query) => $query->select(['date'])->whereBetween('date', [$this->start_of_week, $this->end_of_week]);

        return $status === 'year'
            ?  $students->whereHas('cash_transactions', $callback)->count()
            : $students->whereDoesntHave('cash_transactions', $callback)->count();
    }

    /**
     * Ambil data siswa yang belum membayar uang kas pada minggu ini.
     *
     * Jika limit === null maka tampilkan seluruh data siswa yang belum membayar minggu ini.
     * Jika limit !== null maka tampilkan data siswa yang belum membayar minggu ini dengan limit.
     * 
     * @param string $limit
     * @return Object
     */
    public function getStudentWhoNotPaidThisWeek(string $limit = null): Object
    {
        $students = $this->students->select(['name', 'student_identification_number']);

        $callback = fn (Builder $query) => $query->select(['date'])->whereBetween('date', [$this->start_of_week, $this->end_of_week]);

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
                'not_paid_this_week' => $this->getStudentWhoNotPaidThisWeek(),
                'not_paid_this_week_limit' => $this->getStudentWhoNotPaidThisWeek(6),
            ],
            'student_counts' => [
                'paid_this_week' => $this->countStudentWhoPaidOrNotPaidThisWeek(status: 'year'),
                'not_paid_this_week' => $this->countStudentWhoPaidOrNotPaidThisWeek(status: 'week'),
            ],
            'totals' => [
                'this_month' => indonesian_currency($this->sumAmountBy('month', month: date('m'))),
                'this_year' => indonesian_currency($this->sumAmountBy('year', year: date('Y'))),
            ]
        ];
    }
}
