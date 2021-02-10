<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\CashTransactionRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository
    ) {
    }
    
    public function show($id)
    {
        $data = $this->cashTransactionRepository->findCashTransaction($id);

        $response = [
            'user_id' => $data->users->name,
            'student_name' => $data->students->name,
            'student_id' => $data->students->id,
            'bill' => $data->bill,
            'amount' => $data->amount,
            'is_paid' => $data->is_paid === 1 ? 'Lunas' : 'Belum Lunas',
            'date' => date('d-m-Y', strtotime($data->date)),
            'date_update' => $data->date,
            'note' => $data->note
        ];

        return response()->json(['status' => Response::HTTP_OK, 'data' => $response], Response::HTTP_OK);
    }
}
