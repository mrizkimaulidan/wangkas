<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionRepository extends Controller
{
    private $model;

    public function __construct(CashTransaction $model)
    {
        $this->model = $model;
    }

    /**
     * Ambil seluruh data paling terbaru pada tabel cash_transactions pada database.
     *
     * @return Object
     */
    public function cashTransactionLatest(): Object
    {
        return $this->model->latest()->get();
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
}
