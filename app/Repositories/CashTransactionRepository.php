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
    private $model, $students, $cash_transactions;

    public function __construct(CashTransaction $model, Student $students)
    {
        $this->model = $model;
        $this->students = $students;
        $this->cash_transactions = $model->whereYear('date', date('Y'))->whereMonth('date', date('m'))->pluck('student_id');
    }

    /**
     * Ambil seluruh data paling terbaru pada tabel cash_transactions pada database.
     *
     * @return Object
     */
    public function cashTransactionLatest(): Object
    {
        return $this->model->with('students', 'users')->latest()->get();
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

    public function sumAmountBy(string $year = null, object $start_week = null, object $end_week = null): Int
    {
        $model = $this->model->where('is_paid', 1);

        if (!is_null($year)) {
            return $model->whereYear('date', $year)->sum('amount');
        }

        return $model->where('date', '>', $start_week)
            ->where('date', '<', $end_week)->sum('amount');
    }

    public function countStudentWhoPaidOrNotPaidThisWeek(bool $is_paid): Int
    {
        $cash_transactions = DB::table('cash_transactions')
            ->where('date', '>',  Carbon::now()->startOfWeek())
            ->where('date', '<', Carbon::now()->endOfWeek())->pluck('student_id');

        if ($is_paid) {
            return $this->students->whereIn('id', $cash_transactions)->count();
        }

        return $this->students->whereNotIn('id', $cash_transactions)->count();
    }

    /**
     * Ambil data siswa yang belum membayar uang kas pada minggu ini.
     *
     * @param string $limit
     * @return Object
     */
    public function getStudentWhoNotPaidThisWeek(string $limit = null): Object
    {
        $cash_transactions = DB::table('cash_transactions')
            ->where('date', '>',  Carbon::now()->startOfWeek())
            ->where('date', '<', Carbon::now()->endOfWeek())->pluck('student_id');

        // Jika limit === null maka tampilkan seluruh data siswa yang belum membayar minggu ini.
        if (is_null($limit)) {
            return $this->students->whereNotIn('id', $cash_transactions)->orderBy('name')->get();
        }

        // Jika limit !== null maka tampilkan data siswa yang belum membayar minggu ini dengan limit.
        return $this->students->whereNotIn('id', $cash_transactions)->orderBy('name')->take($limit)->get();
    }
}
