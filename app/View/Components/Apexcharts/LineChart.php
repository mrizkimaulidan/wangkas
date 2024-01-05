<?php

namespace App\View\Components\Apexcharts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LineChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $chartTitle   The title of the chart.
     * @param string $chartID      The unique identifier for the chart.
     * @param string $url          The URL to fetch data for the chart.
     * @param array  $formData     An array containing form data used to customize the data when calling the URL to fetch the data.
     * @param string $seriesTitle  The title for the chart series.
     */
    public function __construct(
        public string $chartTitle,
        public string $chartID,
        public string $url,
        public array $formData,
        public string $seriesTitle
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.apexcharts.line-chart');
    }
}
