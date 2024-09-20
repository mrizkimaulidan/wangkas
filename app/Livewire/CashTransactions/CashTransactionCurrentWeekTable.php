<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use Livewire\Component;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Halaman Daftar Kas Minggu Ini')]
class CashTransactionCurrentWeekTable extends Component
{
    use WithPagination;

    public string $query = '';
    public int $limit = 5;
    public string $orderByColumn = 'date_paid';
    public string $orderBy = 'desc';

    #[On('cash-transaction-created')]
    #[On('cash-transaction-updated')]
    #[On('cash-transaction-deleted')]
    public function render()
    {
        $now = now();
        $cashTransactions = CashTransaction::query()
            ->whereYear('date_paid', $now->year)
            ->whereMonth('date_paid', $now->month)
            ->when($this->query, function (Builder $query) {
                $this->resetPage();
                return $query->where('id', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.cash-transactions.cash-transaction-current-week-table', [
            'cashTransactions' => $cashTransactions,
        ]);
    }

    public function resetFilter()
    {
        $this->reset([
            'query',
            'limit',
            'orderByColumn',
            'orderBy',
        ]);
    }
}
