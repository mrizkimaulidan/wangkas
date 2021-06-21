<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardChartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardChartController extends Controller
{
    public function __construct(
        private DashboardChartRepository $dashboardChartRepository,
    ) {
    }

    public function getDataSeparateByMonths(): JsonResponse
    {
        $cash_transactions = $this->dashboardChartRepository->sumCashTransactionPerMonths();

        return response()->json(['status' => Response::HTTP_OK, 'data' => $cash_transactions], Response::HTTP_OK);
    }
}
