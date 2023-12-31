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
    private $months = ['jan', 'feb', 'mar', 'apr', 'may', 'june', 'july', 'aug', 'sep', 'oct', 'nov', 'dec'];

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
            $collection = $this->applyFilterAllMonths($query, $request->year);

            $statistics = $this->fillMissingMonthsCounts($collection);
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $statistics
            ], Response::HTTP_OK);
        }

        if (is_numeric($request->year)) {
            $collection = $this->applyFilterSpecificYear($query, $request->year);

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
        return $query->selectRaw('MONTH(date_paid) AS month, COUNT(*) AS count')
            ->groupBy('month')
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
        return $query->selectRaw('MONTH(date_paid) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');
    }

    /**
     * Fill in missing counts for each month in the provided collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    private function fillMissingMonthsCounts(SupportCollection $collection): array
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
