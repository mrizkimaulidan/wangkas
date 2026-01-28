<?php

use App\Models\CashTransaction;
use Livewire\Component;

new class extends Component
{
    public CashTransaction $cashTransaction;

    /**
     * Initialize component with data
     */
    public function mount(CashTransaction $cashTransaction): void
    {
        $this->cashTransaction = $cashTransaction;
    }

    /**
     * Process data deletion
     */
    public function destroy(): void
    {
        $this->cashTransaction->delete();

        session()->flash('success', 'Data kas berhasil dihapus!');

        $this->redirectRoute('kas.index', navigate: true);
    }
};
