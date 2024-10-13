<?php

namespace App\Livewire\CashTransactions;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class StudentPaidStatusModal extends Component
{
    #[Reactive]
    public Collection $students;

    public string $modalTitle;

    public function render()
    {
        return view('livewire.cash-transactions.student-paid-status-modal', [
            'students' => $this->students,
            'modalTitle' => $this->modalTitle,
        ]);
    }
}