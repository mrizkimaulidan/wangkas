<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\StoreCashTransaction;
use App\Models\Student;
use Livewire\Component;

class CreateCashTransaction extends Component
{
    public StoreCashTransaction $form;

    public function render()
    {
        $students = Student::all();

        return view('livewire.cash-transactions.create-cash-transaction', [
            'students' => $students,
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
