<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashTransactionRequest;
use App\Http\Requests\UpdateCashTransactionRequest;
use App\Models\CashTransaction;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $cashTransactions = CashTransaction::select('id', 'student_id', 'amount', 'date_paid', 'created_by')
            ->with('student:id,name', 'createdBy:id,name')
            ->whereBetween('date_paid', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->get()
            ->append('amount_formatted')
            ->append('date_paid_formatted');

        return datatables()->of($cashTransactions)
            ->addIndexColumn()
            ->blacklist(['DT_RowIndex'])
            ->addColumn('amount', 'cash_transactions.datatables.amount')
            ->addColumn('action', 'cash_transactions.datatables.action')
            ->rawColumns(['amount', 'action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCashTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCashTransactionRequest $request): JsonResponse
    {
        $now = now();

        $validatedInput = collect($request->validated());
        $studentIDs = collect($validatedInput['student_id']);
        $transformedTransactions = $studentIDs->map(function ($studentID) use ($validatedInput, $now) {
            // recreate student_id from list of array
            // to single value
            return $validatedInput->except('student_id')->merge([
                'student_id' => $studentID,
                'created_at' => $now->toDateTimeString(),
                'updated_at' => $now->toDateTimeString()
            ])->toArray();
        })->toArray();

        $cashTransaction = CashTransaction::insert($transformedTransactions);

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $cashTransaction,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CashTransaction $cashTransaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CashTransaction $cashTransaction): JsonResponse
    {
        $cashTransaction->load(
            'student:id,school_class_id,school_major_id,student_identification_number,name,phone_number',
            'student.schoolClass:id,name',
            'student.schoolMajor:id,name',
            'createdBy:id,name'
        )->append('amount_formatted')
            ->append('date_paid_formatted');;

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $cashTransaction,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCashTransactionRequest $request
     * @param \App\Models\CashTransaction $cashTransaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCashTransactionRequest $request, CashTransaction $cashTransaction): JsonResponse
    {
        $cashTransaction->update($request->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $cashTransaction,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CashTransaction $cashTransaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CashTransaction $cashTransaction): JsonResponse
    {
        $cashTransaction->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
