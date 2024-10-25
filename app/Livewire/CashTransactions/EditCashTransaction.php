<?php

namespace App\Livewire\CashTransactions;

use App\Livewire\Forms\UpdateCashTransactionForm;
use App\Models\CashTransaction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class EditCashTransaction extends Component
{
    public UpdateCashTransactionForm $form;

    public Collection $students;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.cash-transactions.edit-cash-transaction', [
            'students' => $this->students,
        ]);
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('cash-transaction-edit')]
    public function setValue(int $id): void
    {
        $cashTransaction = CashTransaction::find($id);
        $this->form->fill($cashTransaction);
    }

    /**
     * Update the form data and handle the related events.
     */
    public function edit(): void
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('cash-transaction-updated')->to(CashTransactionCurrentWeekTable::class);
    }
}
