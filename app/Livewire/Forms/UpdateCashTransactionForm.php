<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateCashTransactionForm extends Form
{
    public ?CashTransaction $cashTransaction;

    #[Validate]
    public ?string $student_id;

    public ?string $amount;

    public ?string $date_paid;

    public ?string $transaction_note;

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();

        $request = collect($this->all())->merge(['created_by' => Auth::id()])->toArray();

        $this->cashTransaction->update($request);

        $this->reset();
    }

    /**
     * Get the validation rules that apply to the request.
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
