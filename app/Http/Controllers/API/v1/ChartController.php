<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Repositories\StudentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChartController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    private array $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function cashTransactions(Request $request): JsonResponse
    {
        $query = CashTransaction::query();

        $query->when($request->has('year'), function (Builder $q) use ($request) {
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

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function students(Request $request): JsonResponse
    {
        if ($request->by === 'gender') {
            $genderCounts = $this->studentRepository->countStudentGender();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $genderCounts,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ], Response::HTTP_OK);
    }
}
