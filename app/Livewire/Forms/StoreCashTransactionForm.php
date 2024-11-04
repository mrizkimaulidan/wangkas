<?php

namespace App\Livewire\Forms;

use App\Models\CashTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreCashTransactionForm extends Form
{
    #[Validate]
    public ?array $student_ids;

    public ?string $amount;

    public ?string $date_paid;

    public string $transaction_note = '';

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        $this->validate();

        $now = now();
        $requests = collect($this->student_ids)->map(function ($studentID) use ($now) {
            return [
                'student_id' => $studentID,
                'amount' => $this->amount,
                'date_paid' => $this->date_paid,
                'transaction_note' => $this->transaction_note,
                'created_by' => Auth::id(),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        CashTransaction::insert($requests);

        $this->reset(['student_ids', 'amount', 'transaction_note']);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'student_ids' => 'required|exists:students,id',
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
            'student_ids.required' => 'Pelajar tidak boleh kosong!',
            'student_ids.exists' => 'Pelajar yang dipilih tidak valid!',

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
