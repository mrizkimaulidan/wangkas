<?php

namespace App\Http\Controllers\API\v1;

use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CashTransactionEditResource;
use App\Http\Resources\CashTransactionShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    public function show(int $id): JsonResponse
    {
        $cash_transactions = new CashTransactionShowResource(CashTransaction::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->success($cash_transactions, Response::HTTP_OK);
    }

    public function edit(int $id): JsonResponse
    {
        $cash_transactions = new CashTransactionEditResource(CashTransaction::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->success($cash_transactions, Response::HTTP_OK);
    }
}
