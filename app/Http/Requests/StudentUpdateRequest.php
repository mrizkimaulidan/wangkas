<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'student_identification_number' => ['required', 'min:3', 'max:191'],
            'name' => ['required', 'min:3', 'max:191'],
            'gender' => ['required'],
            'school_class_id' => ['required'],
            'school_major_id' => ['required'],
            'email' => ['required', 'email', 'max:191'],
            'phone_number' => ['required', 'min:3', 'max:191'],
            'school_year_start' => ['required'],
            'school_year_end' => ['required']
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
            'student_identification_number.required' => 'Kolom nis/nisn wajib diisi!',
            'student_identification_number.min' => 'Kolom nis/nisn minimal :min karakter!',
            'student_identification_number.max' => 'Kolom nis/nisn maksimal :max karakter!!',

            'name.required' => 'Kolom nama lengkap wajib diisi!',
            'name.min' => 'Kolom nama lengkap minimal :min karakter!',
            'name.max' => 'Kolom nama lengkap maksimal :max karakter!!',

            'gender.required' => 'Kolom jenis kelamin wajib diisi!',

            'school_class_id.required' => 'Kolom kelas wajib diisi!',

            'school_major_id.required' => 'Kolom jurusan wajib diisi!',

            'email.required' => 'Kolom email wajib diisi!',
            'email.email' => 'Kolom email harus email yang valid!',
            'email.max' => 'Kolom email maksimal :max karakter!',

            'phone_number.required' => 'Kolom nomor handphone wajib diisi!',
            'phone_number.min' => 'Kolom nomor handphone :min karakter!',
            'phone_number.max' => 'Kolom nomor handphone :max karakter!',

            'school_year_start.required' => 'Kolom awal tahun ajaran wajib diisi!',

            'school_year_end.required' => 'Kolom akhir tahun ajaran wajib diisi!',
        ];
    }
}
