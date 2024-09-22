<?php

namespace App\Livewire\CashTransactions;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class NotPaidModal extends Component
{
    public Collection $students;

    public function render()
    {
        return view('livewire.cash-transactions.not-paid-modal', [
            'students' => $this->students,
        ]);
    }
}
