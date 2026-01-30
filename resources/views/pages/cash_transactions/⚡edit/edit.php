<?php

use App\Livewire\Forms\UpdateCashTransactionForm;
use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Data Kas')] class extends Component
{
    public CashTransaction $cashTransaction;

    public UpdateCashTransactionForm $form;

    public Collection $students;

    /**
     * Initialize component with data
     */
    public function mount(CashTransaction $cashTransaction)
    {
        $this->students = Student::orderBy('name')->get();

        $this->form->cashTransaction = $cashTransaction;
        $this->form->fill($cashTransaction);
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Data kas berhasil diubah!');

        $this->redirectRoute('kas.index', navigate: true);
    }
};
