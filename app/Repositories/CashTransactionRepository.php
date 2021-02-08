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
        $this->model = $model->with('students', 'users');
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
}
