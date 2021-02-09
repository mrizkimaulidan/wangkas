<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Student;
use Carbon\Carbon;
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

    /**
     * Hitung total kolom amount.
     * Jika $year ada/tidak null maka hitung total kolom amount berdasarkan tahun di parameter.
     * JIka ingin menghitung total kolom amount `hanya` bulan ini.. wajib passing tahunnya berapa.
     * 
     * @param string $year
     * @param string $month
     * @return Int
     */
    public function sumAmountFieldByYearAndMonth(string $year, string $month = null): Int
    {
        $model = $this->model->where('is_paid', 1);

        // Jika $year ada dan $month === null.
        // Berarti hanya hitung total kolom amount berdasarkan tahun saja.
        if (is_null($month)) {
            return $model->whereYear('date', $year)->sum('amount');
        }

        // Jika $year ada dan $month != null.
        // Berarti hitung total kolom amount berdasarkan tahun dan bulan.
        return $model->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');
    }

    /**
     * Ambil data pelajar yang belum membayar uang kas pada tahun dan bulan ini.
     *
     * @param string $limit
     * @return Object
     */
    public function getStudentWhoStillNotPaid(string $limit = null): Object
    {
        $cash_transactions = $this->cash_transactions->all();

        // Jika $limit === null.
        // Tampilkan seluruh pelajar.
        if (is_null($limit)) {
            return $this->students->whereNotIn('id', $cash_transactions)->get();
        }

        // Jika limit !== null.
        // Tampilkan pelajar dengan limit sesuai di parameter.
        return $this->students->whereNotIn('id', $cash_transactions)->orderBy('name', 'asc')->take($limit)->get();
    }

    public function countStudentWhoPaidOrNotPaid(bool $is_paid): Int
    {
        if ($is_paid) {
            return $this->cash_transactions->count();
        }

        return $this->students->whereNotIn('id', $this->cash_transactions)->orderBy('name', 'asc')->count();
    }
}
