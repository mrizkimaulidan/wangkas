<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCashTransaction extends Component
{
    public $cashTransaction;

    public bool $isBatchDelete = false;

    public array $selectedIDs = [];

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.cash-transactions.delete-cash-transaction');
    }

    /**
     * Set the specified model instance for the component.
     */
    #[On('cash-transaction-delete')]
    public function setValue($cashTransaction): void
    {
        // Handle batch delete
        if (is_array($cashTransaction)) {
            $this->isBatchDelete = true;
            $this->selectedIDs = $cashTransaction;
            $this->cashTransaction = null;
        } else {
            $this->isBatchDelete = false;
            $this->selectedIDs = [];
            $this->cashTransaction = $cashTransaction;
        }
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        if ($this->isBatchDelete) {
            $this->batchDelete();

            return;
        }

        $this->singleDelete();
    }

    /**
     * Handle batch delete operation.
     */
    protected function batchDelete(): void
    {
        if ($this->selectedIDs) {
            CashTransaction::destroy($this->selectedIDs);

            $this->dispatch('close-modal');
            $this->dispatch('success', message: 'Data berhasil dihapus!');
            $this->dispatch('cash-transaction-deleted')->to(\App\Livewire\CashTransactions\CashTransactionCurrentWeekTable::class);
        }
    }

    /**
     * Handle single delete operation.
     */
    protected function singleDelete(): void
    {
        $cashTransaction = CashTransaction::find($this->cashTransaction);

        if (! $cashTransaction) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data tidak ditemukan!');

            return;
        }

        $cashTransaction->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('cash-transaction-deleted')->to(\App\Livewire\CashTransactions\CashTransactionCurrentWeekTable::class);
    }
}
