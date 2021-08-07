<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required',
            'bill' => 'required|integer|min:3',
            'amount' => 'required|integer|min:3',
            'is_paid' => 'required',
            'date' => 'required|date',
            'note' => 'max:191'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'bill.required' => 'Kolom tagihan wajib diisi!',
            'bill.integer' => 'Kolom tagihan harus angka!',
            'bill.min' => 'Kolom tagihan minimal 3 karakter!',
            'bill.max' => 'Kolom tagihan maksimal 191 karakter!',

            'amount.required' => 'Kolom total bayar wajib diisi!',
            'amount.integer' => 'Kolom total bayar harus angka!',
            'amount.min' => 'Kolom total bayar minimal 3 karakter!',
            'amount.max' => 'Kolom total bayar maksimal 191 karakter!',

            'is_paid.required' => 'Kolom status pembayaran wajib diisi!',

            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang valid!',

            'note.max' => 'Kolom keterangan maksimal 191 karakter!'
        ];
    }
}
