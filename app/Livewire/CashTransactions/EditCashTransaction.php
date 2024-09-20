<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\UpdateCashTransaction;
use App\Models\CashTransaction;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class EditCashTransaction extends Component
{
    public UpdateCashTransaction $form;

    public Collection $students;

    public function render()
    {
        return view('livewire.cash-transactions.edit-cash-transaction', [
            'students' => $this->students,
        ]);
    }

    #[On('cash-transaction-edit')]
    public function setValue(string $id)
    {
        $cashTransaction = CashTransaction::find($id);
        $this->form->id = $cashTransaction->id;
        $this->form->student_id = $cashTransaction->student_id;
        $this->form->amount = $cashTransaction->amount;
        $this->form->date_paid = $cashTransaction->date_paid;
        $this->form->transaction_note = $cashTransaction->transaction_note;
    }

    public function edit()
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('cash-transaction-updated')->to(CashTransactionCurrentWeekTable::class);
    }
}
