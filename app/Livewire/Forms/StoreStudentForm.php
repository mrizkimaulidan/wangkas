<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreStudentForm extends Form
{
    #[Validate]
    public string $identification_number = '';

    public string $name = '';

    public string $phone_number = '';

    public string $gender = '';

    public string $school_class_id = '';

    public string $school_major_id = '';

    public string $school_year_start = '';

    public string $school_year_end = '';

    public function store()
    {
        $this->validate();

        Student::create($this->pull());
    }

    public function rules(): array
    {
        return [
            'school_class_id' => 'required|numeric|exists:school_classes,id',
            'school_major_id' => 'required|numeric|exists:school_majors,id',
            'identification_number' => 'required|numeric|unique:students,identification_number',
            'name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|numeric|digits_between:3,255|unique:students,phone_number',
            'gender' => 'required|numeric|in:1,2',
            'school_year_start' => 'required|numeric|digits_between:3,255',
            'school_year_end' => 'required|numeric|digits_between:3,255',
        ];
    }

    public function messages(): array
    {
        return [
            'school_class_id.required' => 'Kolom kelas tidak boleh kosong!',
            'school_class_id.numeric' => 'Kolom kelas harus berupa angka!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak ditemukan!',

            'school_major_id.required' => 'Kolom jurusan tidak boleh kosong!',
            'school_major_id.numeric' => 'Kolom jurusan harus berupa angka!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak ditemukan!',

            'identification_number.required' => 'Kolom nomor identitas tidak boleh kosong!',
            'identification_number.numeric' => 'Kolom nomor identitas harus berupa angka!',
            'identification_number.unique' => 'Nomor identitas sudah digunakan!',

            'name.required' => 'Kolom nama lengkap tidak boleh kosong!',
            'name.string' => 'Kolom nama lengkap harus berupa teks!',
            'name.min' => 'Panjang nama lengkap minimal :min karakter!',
            'name.max' => 'Panjang nama lengkap maksimal :max karakter!',

            'phone_number.required' => 'Kolom nomor telepon tidak boleh kosong!',
            'phone_number.numeric' => 'Kolom nomor telepon harus berupa angka!',
            'phone_number.digits_between' => 'Panjang nomor telepon harus antara :min dan :max digit!',
            'phone_number.unique' => 'Nomor telepon sudah digunakan!',

            'gender.required' => 'Kolom jenis kelamin tidak boleh kosong!',
            'gender.numeric' => 'Kolom jenis kelamin harus berupa angka!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Kolom tahun masuk tidak boleh kosong!',
            'school_year_start.numeric' => 'Kolom tahun masuk harus berupa angka!',
            'school_year_start.digits_between' => 'Panjang tahun masuk harus antara :min dan :max digit!',

            'school_year_end.required' => 'Kolom tahun lulus tidak boleh kosong!',
            'school_year_end.numeric' => 'Kolom tahun lulus harus berupa angka!',
            'school_year_end.digits_between' => 'Panjang tahun lulus harus antara :min dan :max digit!',
        ];
    }
}
