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
            'student_id' => ['required'],
            'bill' => ['required', 'integer', 'digits_between:3,191'],
            'amount' => ['required', 'integer', 'digits_between:3,191'],
            'is_paid' => ['required'],
            'date' => ['required', 'date'],
            'note' => ['max:191']
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'bill.required' => 'Kolom tagihan wajib diisi!',
            'bill.integer' => 'Kolom tagihan harus angka!',
            'bill.digits_betweeen' => 'Kolom tagihan harus diantara 3 sampai dengan 191 karakter!',

            'amount.required' => 'Kolom total bayar wajib diisi!',
            'amount.integer' => 'Kolom total bayar harus angka!',
            'amount.digits_betweeen' => 'Kolom total bayar harus diantara 3 sampai dengan 191 karakter!',

            'is_paid.required' => 'Kolom status pembayaran wajib diisi!',
            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang benar!',

            'note.max' => 'Kolom catatan maksimal 191 karakter!'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'student_id' => (object) $this->get('student_id')
        ]);
    }
}
