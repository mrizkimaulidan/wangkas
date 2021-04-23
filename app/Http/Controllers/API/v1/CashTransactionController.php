<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id)
    {
        $cash_transaction = CashTransaction::select('id', 'student_id', 'bill', 'amount', 'is_paid', 'date', 'note')
            ->findOrFail($id);

        $response = [
            'id' => $cash_transaction->id,
            'student_id' => $cash_transaction->student_id,
            'bill' => $cash_transaction->bill,
            'amount' => $cash_transaction->amount,
            'is_paid' => $cash_transaction->is_paid,
            'date' => $cash_transaction->date,
            'note' => $cash_transaction->note
        ];

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $response
        ], Response::HTTP_OK);
    }
}
