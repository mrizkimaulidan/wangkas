<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCashTransaction extends Component
{
    public CashTransaction $cashTransaction;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.cash-transactions.delete-cash-transaction');
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('cash-transaction-delete')]
    public function setValue(int $id): void
    {
        $this->cashTransaction = CashTransaction::find($id);
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        $this->cashTransaction->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('cash-transaction-deleted')->to(CashTransactionCurrentWeekTable::class);
    }
}
