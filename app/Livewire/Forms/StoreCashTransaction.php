<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreCashTransaction extends Form
{
    #[Validate]
    public string $student_id = '';
    public string $amount = '';
    public string $date_paid = '';
    public string $transaction_note = '';

    public function store()
    {
        $this->validate();

        $request = collect($this->pull())->merge(['created_by' => Auth::id()])->toArray();

        CashTransaction::create($request);
    }

    public function rules()
    {
        return [
            'student_id' => 'required',
            'amount' => 'required',
            'date_paid' => 'required',
            'transaction_note' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Kolom pelajar tidak boleh kosong!',
            'amount.required' => 'Kolom tagihan tidak boleh kosong!',
            'date_paid.required' => 'Kolom tanggal tidak boleh kosong!',
        ];
    }
}
