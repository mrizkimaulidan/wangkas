<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionFilterRequest extends FormRequest
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
            'start_date' => 'required_with:end_date|date',
            'end_date' => 'required_with:start_date|date|after_or_equal:start_date',
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
            'start_date.required_with' => 'Tanggal mulai harus diisi jika tanggal akhir ada!',
            'start_date.date' => 'Format tanggal mulai tidak valid!',

            'end_date.required_with' => 'Tanggal akhir harus diisi jika tanggal mulai ada!',
            'end_date.date' => 'Format tanggal akhir tidak valid!',
            'end_date.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai!',
        ];
    }
}
