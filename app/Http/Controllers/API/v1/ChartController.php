<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChartController extends Controller
{
    private $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

    public function cashTransactions(Request $request)
    {
        $query = CashTransaction::query();

        $query->when($request->has('year'), function ($q) use ($request) {
            return $q->whereYear('date_paid', $request->year);
        });

        $results = $query->selectRaw('EXTRACT(MONTH FROM date_paid) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        for ($i = 1; $i <= 12; $i++) {
            // if key exists so there is a borrowing count on that month
            // if key does not exists there is no borrowing on that month so the count
            // should be 0
            $statistics[$this->months[$i - 1]] = isset($results[$i]) ? $results[$i] : 0;
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
            'data' => $statistics,
        ], Response::HTTP_OK);
    }

    public function students(Request $request)
    {
        if ($request->by === 'gender') {
            $genderCount = [
                'male' => 0,
                'female' => 0,
            ];

            $genderCount['male'] = Student::select('gender')->where('gender', 1)->count();
            $genderCount['female'] = Student::select('gender')->where('gender', 2)->count();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $genderCount,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ], Response::HTTP_OK);
    }
}