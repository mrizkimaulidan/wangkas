<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionUpdateRequest extends FormRequest
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
            'bill' => 'required|numeric|digits_between:3,191',
            'amount' => 'required|numeric|digits_between:3,191',
            'date' => 'required|date',
            'note' => 'max:191'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'bill.required' => 'Kolom tagihan wajib diisi!',
            'bill.numeric' => 'Kolom tagihan harus angka!',
            'bill.digits_between' => 'Kolom tagihan maksimal 191 karakter!',

            'amount.required' => 'Kolom total bayar wajib diisi!',
            'amount.numeric' => 'Kolom total bayar harus angka!',
            'amount.digits_between' => 'Kolom total bayar maksimal 191 karakter!',

            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang valid!',

            'note.max' => 'Kolom keterangan maksimal 191 karakter!'
        ];
    }
}
