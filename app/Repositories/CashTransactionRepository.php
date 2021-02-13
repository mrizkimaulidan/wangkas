<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Student;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CashTransactionRepository extends Controller
{
    private $model, $students, $cash_transaction_is_paid, $pluck_student_id;

    public function __construct(CashTransaction $model, Student $students)
    {
        $this->model = $model;
        $this->students = $students;
        $this->cash_transaction_is_paid = $model->where('is_paid', 1);
        $this->pluck_student_id = DB::table('cash_transactions')->where('date', '>',  Carbon::now()->startOfWeek())->where('date', '<', Carbon::now()->endOfWeek())->pluck('student_id');
    }

    /**
     * Ambil seluruh data paling terbaru pada tabel cash_transactions pada database.
     * Jika $limit ada isinya, maka tampilkan data paling terbaru pada tabel cash_transactions dengan limi.
     *
     * @param $limit
     * @return Object
     */
    public function cashTransactionLatest(int $limit = null): Object
    {
        $model = $this->model->with('students', 'users');

        // Jika $limit !== null maka tampilkan seluruh data cash_transactions dengan limit.
        if (!is_null($limit)) {
            return $model->take($limit)->latest()->get();
        }

        // Jika $limit === null maka tampilkan seluruh data cash_transactions tanpa limit.
        return $model->latest()->get();
    }

    /**
     * Ubah data kas di tabel cash_transactions pada database sesuai dengan id kas tersebut.
     *
     * @param Request $request
     * @param string $id
     * @return Bool
     */
    public function update(Request $request, string $id): Bool
    {
        $this->model = $this->findCashTransaction($id);

        return $this->model->update([
            'student_id' => $request->student_id,
            'bill' => $request->bill,
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    /**
     * Tambah data ke tabel cash_transactions pada database.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return $this->model->create([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'bill' => $request->bill,
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date' => $request->date,
            'note' => $request->note
        ]);
    }

    /**
     * Ambil single data kas di tabel cash_transaction berdasarkan id di parameter.
     *
     * @param string $id
     * @return Object
     */
    public function findCashTransaction(string $id): Object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Hitung status lunas atau belum lunas berdasarkan parameter.
     *
     * @param bool $paid_status
     * @return Int
     */
    public function countPaidOrNotPaid(bool $paid_status): Int
    {
        return $this->model->where('is_paid', $paid_status)->count();
    }

    /**
     * Hitung total kolom amount di tabel cash_transactions berdasarkan tahun atau minggu.
     * 
     * Jika $status === `year` dan variabel $year ada isinya, maka hitung total kolom amount di tabel cash_transaction berdasarkan tahun sesuai di parameter.
     * Jika $status === `month` dan variabel $month ada isinya, maka hitung total kolom amount di tabel cash_transaction berdasarkan bulan sesuai di parameter.
     *
     * Jika $status === `year` maka hanya isi parameter $year.
     * jika $status === `month` maka hanya isi parameter $month.
     * 
     * @param string $year adalah tahun, contoh : 2021, 2022, 2023, dst..
     * @param string $month adalah bulan dengan 0, contoh : 01, 02, 03, dst..
     * @return Int
     */
    public function sumAmountBy(string $status, string $year = null, string $month = null): Int
    {
        $status_lowercase = strtolower($status);

        $model = $this->cash_transaction_is_paid;

        // Jika $status === `year` dan variabel $year ada isinya, maka hitung kolom amount berdasarkan tahun di parameter.
        if ($status_lowercase === 'year' && isset($year)) {
            $model->whereYear('date', $year);
        }

        // Jika $status === `month` dan variabel $month ada isinya, maka hitung kolom amount berdasarkan bulan di parameter.
        if ($status_lowercase === 'month' && isset($month)) {
            $model->whereYear('date', date('Y'))->whereMonth('date', $month);
        }

        return $model->sum('amount');
    }

    /**
     * Hitung siswa yang sudah atau belum membayar pada minggu ini.
     * 
     * Jika $is_paid === true, maka hitung berapa siswa yang sudah membayar pada minggu ini.
     * Jika $is_paid === false, maka hitung berapa siswa yang belum membayar pada minggu ini.
     *
     * @param boolean $is_paid
     * @return Int
     */
    public function countStudentWhoPaidOrNotPaidThisWeek(bool $is_paid): Int
    {
        if ($is_paid) {
            return $this->students->whereIn('id', $this->pluck_student_id)->count();
        }

        return $this->students->whereNotIn('id', $this->pluck_student_id)->count();
    }

    /**
     * Ambil data siswa yang belum membayar uang kas pada minggu ini.
     *
     * @param string $limit
     * @return Object
     */
    public function getStudentWhoNotPaidThisWeek(string $limit = null): Object
    {
        // Jika limit === null maka tampilkan seluruh data siswa yang belum membayar minggu ini.
        if (is_null($limit)) {
            return $this->students->whereNotIn('id', $this->pluck_student_id)->orderBy('name')->get();
        }

        // Jika limit !== null maka tampilkan data siswa yang belum membayar minggu ini dengan limit.
        return $this->students->whereNotIn('id', $this->pluck_student_id)->orderBy('name')->take($limit)->get();
    }
}
