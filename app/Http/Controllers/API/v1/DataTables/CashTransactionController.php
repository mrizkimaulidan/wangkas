<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            ->whereYear('date_paid', now()->year)
            ->whereMonth('date_paid', now()->month)
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'date_paid' => 'required|date',
            'transaction_note' => 'nullable|string|min:3|max:255',
            'created_by' => 'required|numeric|exists:users,id',
        ];

        $messages = [
            'student_id.required' => 'Kolom pelajar harus diisi!',
            'student_id.exists' => 'Pelajar yang dipilih tidak ditemukan!',

            'amount.required' => 'Kolom tagihan harus diisi!',
            'amount.numeric' => 'Kolom tagihan harus berupa angka!',

            'date_paid.required' => 'Kolom tanggal pembayaran harus diisi!',
            'date_paid.date' => 'Format tanggal pembayaran tidak valid!',

            'transaction_note.string' => 'Kolom catatan transaksi harus berupa teks!',
            'transaction_note.min' => 'Panjang catatan transaksi minimal :min karakter!',
            'transaction_note.max' => 'Panjang catatan transaksi maksimal :max karakter!',

            'created_by.required' => 'Pencatat transaksi harus diisi!',
            'created_by.numeric' => 'Pencatat transaksi harus berupa angka!',
            'created_by.unique' => 'Pencatat transaksi tidak ditemukan!.',
        ];

        // TODO: the created_by should dynamic ID from authenticated user!
        $validator = Validator::make($request->merge(['created_by' => 1])->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $validatedInput = collect($validator->validated());
        $studentIDs = collect($validatedInput['student_id']);
        $transformedTransactions = $studentIDs->map(function ($studentID) use ($validatedInput) {
            // recreate student_id from list of array
            // to single value
            return $validatedInput->except('student_id')->merge(['student_id' => $studentID])->toArray();
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CashTransaction $cashTransaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CashTransaction $cashTransaction): JsonResponse
    {
        $rules = [
            'student_id' => 'required|numeric|exists:students,id',
            'amount' => 'required|numeric',
            'date_paid' => 'required|date',
            'transaction_note' => 'nullable|string|min:3|max:255',
            'created_by' => 'required|numeric|exists:users,id',
        ];

        $messages = [
            'student_id.required' => 'Kolom pelajar harus diisi!',
            'student_id.numeric' => 'Kolom pelajar harus berupa angka!',
            'student_id.exists' => 'Pelajar yang dipilih tidak ditemukan!',

            'amount.required' => 'Kolom tagihan harus diisi!',
            'amount.numeric' => 'Kolom tagihan harus berupa angka!',

            'date_paid.required' => 'Kolom tanggal pembayaran harus diisi!',
            'date_paid.date' => 'Format tanggal pembayaran tidak valid!',

            'transaction_note.string' => 'Kolom catatan transaksi harus berupa teks!',
            'transaction_note.min' => 'Panjang catatan transaksi minimal :min karakter!',
            'transaction_note.max' => 'Panjang catatan transaksi maksimal :max karakter!',

            'created_by.required' => 'Pencatat transaksi harus diisi!',
            'created_by.numeric' => 'Pencatat transaksi harus berupa angka!',
            'created_by.unique' => 'Pencatat transaksi tidak ditemukan!.',
        ];

        // TODO: the created_by should dynamic ID from authenticated user!
        $validator = Validator::make($request->merge(['created_by' => 1])->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $cashTransaction->update($validator->validated());

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
