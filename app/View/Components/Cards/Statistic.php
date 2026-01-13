<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Statistic extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public $count,
        public string $icon,
        public string $color = '',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.statistic');
    }
}
