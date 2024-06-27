<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCashTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|numeric|exists:students,id',
            'amount' => 'required|numeric',
            'date_paid' => 'required|date',
            'transaction_note' => 'nullable|string|min:3|max:255',
            'created_by' => 'required|numeric|exists:users,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Kolom pelajar harus diisi!',
            'student_id.numeric' => 'Kolom pelajar harus berupa angka!',
            'student_id.exists' => 'Pelajar yang dipilih tidak ditemukan!',

            'amount.required' => 'Kolom tagihan harus diisi!',
            'amount.numeric' => 'Kolom tagihan harus berupa angka!',

            'date_paid.required' => 'Kolom tanggal pembayaran harus diisi!',
            'date_paid.date' => 'Format tanggal pembayaran tidak valid!',

            'transaction_note.string' => 'Kolom catatan transaksi harus berupa teks!',
            'transaction_note.min' => 'Panjang catatan transaksi minimal :min karakter!',
            'transaction_note.max' => 'Panjang catatan transaksi maksimal :max karakter!',

            'created_by.required' => 'Pencatat transaksi harus diisi!',
            'created_by.numeric' => 'Pencatat transaksi harus berupa angka!',
            'created_by.unique' => 'Pencatat transaksi tidak ditemukan!.',
        ];
    }
}
