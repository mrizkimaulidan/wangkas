<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CashTransactionEditResource;
use App\Http\Resources\CashTransactionShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $cash_transactions = new CashTransactionShowResource(CashTransaction::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $cash_transactions
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $cash_transactions = new CashTransactionEditResource(CashTransaction::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $cash_transactions
        ]);
    }
}
