<?php

namespace App\View\Components\Apexcharts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PieChart extends Component
{
    /**
     * Create a new instance of the chart component.
     *
     * @param string $chartTitle The title of the chart.
     * @param string $chartID The unique identifier for the chart.
     * @param $series The data series for the chart.
     * @param $labels The labels for the chart data.
     * @param ?array $colors (Optional) The colors for the chart data.
     */
    public function __construct(
        public string $chartTitle,
        public string $chartID,
        public $series,
        public $labels,
        public ?array $colors = null
    ) {
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.apexcharts.pie-chart');
    }
}
