<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\CashTransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CashTransactionStatisticController extends Controller
{
    private $months = ['jan', 'feb', 'mar', 'apr', 'may', 'june', 'july', 'aug', 'sep', 'oct', 'nov', 'dec'];

    public function __construct(
        private CashTransactionRepository $cashTransactionRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if ($request->year === 'per_year') {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $this->cashTransactionRepository->applyFilterPerYear()
            ]);
        }

        if ($request->year === 'all') {
            $collection = $this->cashTransactionRepository->applyFilterAllMonths($request->year);
            $statistics = $this->fillMissingMonthsCounts($collection);

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $statistics
            ], Response::HTTP_OK);
        }

        if (is_numeric($request->year)) {
            $collection = $this->cashTransactionRepository->applyFilterSpecificYear($request->year);
            $statistics = $this->fillMissingMonthsCounts($collection);

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $statistics
            ], Response::HTTP_OK);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ], Response::HTTP_OK);
    }

    /**
     * Fill in missing counts for each month in the provided collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    private function fillMissingMonthsCounts(Collection $collection): array
    {
        $statistics = [];

        for ($i = 1; $i <= 12; $i++) {
            // if key exists so there is a borrowing count on that month
            // if key does not exists there is no borrowing on that month so the count
            // should be 0
            $statistics[$this->months[$i - 1]] = isset($collection[$i]) ? $collection[$i] : 0;
        }

        return $statistics;
    }
}
