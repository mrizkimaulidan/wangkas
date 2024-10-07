<?php

namespace App\View\Components\Apexcharts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LineChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $chartTitle,
        public string $seriesTitle,
        public string $chartID,
        public $series,
        public $categories
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.apexcharts.line-chart');
    }
}
