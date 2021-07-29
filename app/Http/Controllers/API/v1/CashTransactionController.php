<?php

namespace App\Http\Controllers\API\v1;

use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CashTransactionResource;
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
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => new CashTransactionResource(CashTransaction::with('students', 'users')->findOrFail($id))
        ], Response::HTTP_OK);
    }
}
