<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection as SupportCollection;

class CashTransactionStatisticController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $query = CashTransaction::query();

        if ($request->year === 'per_year') {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $this->applyFilterPerYear($query)
            ]);
        }

        if ($request->year === 'all') {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $this->applyFilterAllMonths($query)
            ]);
        }

        if (is_numeric($request->year)) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $this->applyFilterSpecificYear($query, $request->year)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ], Response::HTTP_OK);
    }

    /**
     * Apply filter to retrieve cash transaction data grouped by year.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Support\Collection
     */
    private function applyFilterPerYear(Builder $query): SupportCollection
    {
        return $query->selectRaw('YEAR(date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get()
            ->pluck('count', 'year');
    }

    /**
     * Apply filter to retrieve cash transaction data grouped by month and ordered by month.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Support\Collection
     */
    private function applyFilterAllMonths(Builder $query): SupportCollection
    {
        return $query->selectRaw('LEFT(LOWER(MONTHNAME(date_paid)), 3) AS month, COUNT(*) AS count')
            ->groupBy('month')
            ->orderByRaw('MONTH(date_paid)')
            ->get()
            ->pluck('count', 'month');
    }

    /**
     * Apply filter to retrieve cash transaction data for a specific year grouped by month and ordered by month.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    private function applyFilterSpecificYear(Builder $query, $year): SupportCollection
    {
        return $query->selectRaw('LEFT(LOWER(MONTHNAME(date_paid)), 3) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->orderByRaw('MONTH(date_paid)')
            ->get()
            ->pluck('count', 'month');
    }
}
