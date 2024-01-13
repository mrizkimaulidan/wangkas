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
    private $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

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
        $response = [
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ];

        if ($request->type === 'counts' && is_numeric($request->by)) {
            $collection = $this->cashTransactionRepository->getCountsSpecificYear($request->by);
            $response['data'] = $this->fillMissingMonthsCounts($collection);
        }

        if ($request->type === 'amounts' && is_numeric($request->by)) {
            $collection = $this->cashTransactionRepository->getTotalAmountsSpecificYear($request->by);
            $response['data'] = $this->fillMissingMonthsCounts($collection);
        }

        return response()->json($response, Response::HTTP_OK);
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
