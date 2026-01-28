<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreCashTransactionForm extends Form
{
    #[Validate]
    public int $student_id = 0;

    public int $amount = 0;

    public string $date_paid = '';

    public string $transaction_note = '';

    public int $created_by = 0;

    /**
     * Save new data to database
     */
    public function store(): void
    {
        $this->validate();

        CashTransaction::create($this->all());

        $this->reset();
    }

    /**
     * Validation rules for the form fields
     */
    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'amount' => [
                'required',
                'integer',
                'min:1000',
                'max:10000000',
            ],
            'date_paid' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
            'transaction_note' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Pilih pelajar terlebih dahulu!',
            'student_id.exists' => 'Pelajar yang dipilih tidak valid!',

            'amount.required' => 'Jumlah bayar harus diisi!',
            'amount.integer' => 'Jumlah bayar harus berupa angka bulat!',
            'amount.min' => 'Jumlah bayar minimal Rp :min!',
            'amount.max' => 'Jumlah bayar maksimal Rp :max!',

            'date_paid.required' => 'Tanggal bayar harus diisi!',
            'date_paid.date' => 'Format tanggal tidak valid!',
            'date_paid.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini!',

            'transaction_note.string' => 'Catatan harus berupa teks!',
            'transaction_note.max' => 'Catatan maksimal :max karakter!',
        ];
    }
}
