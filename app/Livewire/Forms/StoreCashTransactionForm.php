<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreCashTransactionForm extends Form
{
    #[Validate]
    public string $student_id = '';

    public string $amount = '';

    public string $date_paid = '';

    public string $transaction_note = '';

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        $this->validate();

        $request = collect($this->all())->merge(['created_by' => Auth::id()])->toArray();

        CashTransaction::create($request);

        $this->reset(['student_id', 'amount', 'transaction_note']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'date_paid' => 'required|date',
            'transaction_note' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Pelajar tidak boleh kosong!',
            'student_id.exists' => 'Pelajar yang dipilih tidak valid!',

            'amount.required' => 'Tagihan tidak boleh kosong!',
            'amount.numeric' => 'Tagihan harus berupa angka!',
            'amount.min' => 'Tagihan tidak boleh kurang dari 0!',

            'date_paid.required' => 'Tanggal tidak boleh kosong!',
            'date_paid.date' => 'Tanggal tidak valid!',

            'transaction_note.string' => 'Catatan transaksi harus berupa teks!',
            'transaction_note.max' => 'Catatan transaksi harus maksimal :max karakter!',
        ];
    }
}
