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
            'student_identification_number' => 'required|numeric|digits_between:3, 191',
            'name' => 'required|min:3|max:191',
            'gender' => 'required|max:191',
            'school_class_id' => 'required|max:191',
            'school_major_id' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone_number' => 'required|numeric|digits_between:3, 191',
            'school_year_start' => 'required|numeric|digits_between:3, 191',
            'school_year_end' => 'required|numeric|digits_between:3, 191'
        ];
    }

    public function messages()
    {
        return [
            'student_identification_number.required' => 'Kolom nis/nisn wajib diisi!',
            'student_identification_number.numeric' => 'Kolom nis/nisn harus angka!',
            'student_identification_number.digit_between' => 'Kolom nis/nisn maksimal 191 karakter!',

            'name.required' => 'Kolom nama lengkap wajib diisi!',
            'name.min' => 'Kolom nama lengkap minimal 3 karakter!',
            'name.max' => 'Kolom nama lengkap maksimal 191 karakter!',

            'gender.required' => 'Kolom jenis kelamin wajib diisi!',
            'gender.max' => 'Kolom jenis kelamin maksimal 191 karakter!',

            'school_class_id.required' => 'Kolom kelas wajib diisi!',
            'school_class_id.max' => 'Kolom kelas maksimal 191 karakter!',

            'school_major_id.required' => 'Kolom jurusan wajib diisi!',
            'school_major_id.max' => 'Kolom jurusan maksimal 191 karakter!',

            'email.required' => 'Kolom email wajib diisi!',
            'email.email' => 'Kolom email harus email yang valid!',
            'email.max' => 'Kolom email maksimal 191 karakter!',

            'phone_number.required' => 'Kolom nomor handphone wajib diisi!',
            'phone_number.numeric' => 'Kolom nomor handphone harus angka!',
            'phone_number.digit_between' => 'Kolom nomor handphone maksimal 191 karakter!',

            'school_year_start.required' => 'Kolom awal tahun ajaran wajib diisi!',
            'school_year_start.numeric' => 'Kolom awal tahun ajaran harus angka!',
            'school_year_start.digit_between' => 'Kolom awal tahun ajaran maksimal 191 karakter!',

            'school_year_end.required' => 'Kolom akhir tahun ajaran wajib diisi!',
            'school_year_end.numeric' => 'Kolom akhir tahun ajaran harus angka!',
            'school_year_end.digit_between' => 'Kolom akhir tahun ajaran maksimal 191 karakter!',
        ];
    }
}
