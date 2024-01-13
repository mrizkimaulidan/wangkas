<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use App\Services\ChartGenerator;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private ChartGenerator $chartGenerator
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $charts = $this->chartGenerator->generateCharts();

        return view('dashboard', compact('charts'));
    }
}
