<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id): JsonResponse
    {
        $cash_transaction = CashTransaction::with('students:id,name', 'users:id,name')
            ->select('id', 'student_id', 'user_id', 'bill', 'amount', 'is_paid', 'date', 'note')
            ->findOrFail($id);

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $cash_transaction
        ], Response::HTTP_OK);
    }
}
