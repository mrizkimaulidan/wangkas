<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CashTransactionPaidStatusModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $modalID,
        public string $modalTitle,
        public Collection $students
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cash-transaction-paid-status-modal');
    }
}
