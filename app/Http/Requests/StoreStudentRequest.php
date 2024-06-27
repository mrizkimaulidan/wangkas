<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'school_class_id' => 'required|numeric|exists:school_classes,id',
            'school_major_id' => 'required|numeric|exists:school_majors,id',
            'student_identification_number' => 'required|numeric|unique:students,student_identification_number',
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:students,email',
            'phone_number' => 'required|numeric|digits_between:3,255|unique:students,phone_number',
            'gender' => 'required|numeric|in:1,2',
            'school_year_start' => 'required|numeric|digits_between:3,255',
            'school_year_end' => 'required|numeric|digits_between:3,255',
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
            'school_class_id.required' => 'Kolom kelas harus diisi!',
            'school_class_id.numeric' => 'Kolom kelas harus berupa angka!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak ditemukan!',

            'school_major_id.required' => 'Kolom jurusan harus diisi!',
            'school_major_id.numeric' => 'Kolom jurusan harus berupa angka!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak ditemukan!',

            'student_identification_number.required' => 'Kolom nomor identitas pelajar harus diisi!',
            'student_identification_number.numeric' => 'Kolom nomor identitas pelajar harus berupa angka!',
            'student_identification_number.unique' => 'Nomor identitas pelajar sudah digunakan!',

            'name.required' => 'Kolom nama harus diisi!',
            'name.string' => 'Kolom nama harus berupa teks!',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Panjang email minimal :min karakter!',
            'email.max' => 'Panjang email maksimal :max karakter!',
            'email.unique' => 'Email sudah digunakan!',

            'phone_number.required' => 'Kolom nomor telepon harus diisi!',
            'phone_number.numeric' => 'Kolom nomor telepon harus berupa angka!',
            'phone_number.digits_between' => 'Panjang nomor telepon harus antara :min dan :max digit!',
            'phone_number.unique' => 'Nomor telepon sudah digunakan!',

            'gender.required' => 'Kolom jenis kelamin harus diisi!',
            'gender.numeric' => 'Kolom jenis kelamin harus berupa angka!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Kolom tahun masuk harus diisi!',
            'school_year_start.numeric' => 'Kolom tahun masuk harus berupa angka!',
            'school_year_start.digits_between' => 'Panjang tahun masuk harus antara :min dan :max digit!',

            'school_year_end.required' => 'Kolom tahun lulus harus diisi!',
            'school_year_end.numeric' => 'Kolom tahun lulus harus berupa angka!',
            'school_year_end.digits_between' => 'Panjang tahun lulus harus antara :min dan :max digit!',
        ];
    }
}
