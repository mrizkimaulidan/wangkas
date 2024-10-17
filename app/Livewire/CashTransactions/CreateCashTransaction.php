<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\StoreCashTransactionForm;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateCashTransaction extends Component
{
    public StoreCashTransactionForm $form;

    public Collection $students;

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $this->form->date_paid = now()->toDateString();
    }

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.cash-transactions.create-cash-transaction', [
            'students' => $this->students,
        ]);
    }

    /**
     * Save the form data and handle the related events.
     */
    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('cash-transaction-created')->to(CashTransactionCurrentWeekTable::class);
    }
}
