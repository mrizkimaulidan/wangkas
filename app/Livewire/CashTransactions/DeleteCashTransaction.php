<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCashTransaction extends Component
{
    public CashTransaction $cashTransaction;

    public function render()
    {
        return view('livewire.cash-transactions.delete-cash-transaction');
    }

    #[On('cash-transaction-delete')]
    public function setValue(string $id)
    {
        $this->cashTransaction = CashTransaction::find($id);
    }

    public function destroy()
    {
        $this->cashTransaction->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('cash-transaction-deleted')->to(CashTransactionCurrentWeekTable::class);
    }
}
