<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolMajorUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'abbreviated_word' => 'required|max:191'
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
            'name.required' => 'Kolom nama jurusan wajib diisi!',
            'name.min' => 'Kolom nama jurusan minimal 3 karakter!',
            'name.max' => 'Kolom nama jurusan maksimal 191 karakter!',

            'abbreviated_word.required' => 'Kolom singkatan jurusan wajib diisi!',
            'abbreviated_word.max' => 'Kolom singkatan jurusan maksimal 191 karakter!'
        ];
    }
}
