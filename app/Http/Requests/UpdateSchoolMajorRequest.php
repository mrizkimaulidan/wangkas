<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolMajorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:255|unique:school_majors,abbreviation,' . $this->school_major->id,
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
            'name.required' => 'Kolom nama harus diisi',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'abbreviation.required' => 'Kolom singkatan harus diisi',
            'abbreviation.min' => 'Panjang singkatan minimal :min karakter!',
            'abbreviation.max' => 'Panjang singkatan maksimal :max karakter!',
            'abbreviation.unique' => 'Singkatan sudah digunakan!',
        ];
    }
}
