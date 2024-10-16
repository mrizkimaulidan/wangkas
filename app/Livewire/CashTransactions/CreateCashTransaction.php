<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\StoreCashTransactionForm;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateCashTransaction extends Component
{
    public StoreCashTransactionForm $form;

    public Collection $students;

    public function mount()
    {
        $this->form->date_paid = now()->toDateString();
    }

    public function render()
    {
        return view('livewire.cash-transactions.create-cash-transaction', [
            'students' => $this->students,
        ]);
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('cash-transaction-created')->to(CashTransactionCurrentWeekTable::class);
    }
}
