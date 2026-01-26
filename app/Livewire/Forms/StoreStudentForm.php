<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreStudentForm extends Form
{
    #[Validate]
    public int $school_major_id = 0;

    public int $school_class_id = 0;

    public string $identification_number = '';

    public string $name = '';

    public string $phone_number = '';

    public int $gender = 0;

    public string $school_year_start = '';

    public string $school_year_end = '';

    /**
     * Save new data to database
     */
    public function store(): void
    {
        $this->validate();

        Student::create($this->all());

        $this->reset();
    }

    /**
     * Validation rules for the form fields
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'identification_number' => [
                'required',
                'string',
                'min:1',
                'max:255',
                Rule::unique('students', 'identification_number'),
            ],
            'school_major_id' => [
                'required',
                'integer',
                'exists:school_majors,id',
            ],
            'school_class_id' => [
                'required',
                'integer',
                'exists:school_classes,id',
            ],
            'phone_number' => [
                'required',
                'string',
                'min:1',
                'max:255',
                'regex:/^[0-9]+$/',
            ],
            'gender' => [
                'required',
                'integer',
                'in:1,2',
            ],
            'school_year_start' => [
                'required',
                'integer',
                'digits:4',
            ],
            'school_year_end' => [
                'required',
                'integer',
                'digits:4',
                'gte:school_year_start',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama lengkap harus diisi!',
            'name.string' => 'Kolom nama lengkap harus berupa karakter!',
            'name.min' => 'Kolom nama lengkap minimal :min karakter!',
            'name.max' => 'Kolom nama lengkap maksimal :max karakter!',

            'identification_number.required' => 'Kolom nomor identitas harus diisi!',
            'identification_number.string' => 'Kolom nomor identitas harus berupa karakter!',
            'identification_number.min' => 'Kolom nomor identitas minimal :min karakter!',
            'identification_number.max' => 'Kolom nomor identitas maksimal :max karakter!',
            'identification_number.unique' => 'Nomor identitas sudah digunakan!',

            'school_major_id.required' => 'Kolom jurusan harus dipilih!',
            'school_major_id.integer' => 'Kolom jurusan harus berupa angka!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak valid!',

            'school_class_id.required' => 'Kolom kelas harus dipilih!',
            'school_class_id.integer' => 'Kolom kelas harus berupa angka!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak valid!',

            'phone_number.required' => 'Kolom nomor telepon harus diisi!',
            'phone_number.string' => 'Kolom nomor telepon harus berupa karakter!',
            'phone_number.min' => 'Kolom nomor telepon minimal :min digit!',
            'phone_number.max' => 'Kolom nomor telepon maksimal :max digit!',
            'phone_number.regex' => 'Kolom nomor telepon hanya boleh berisi angka!',

            'gender.required' => 'Kolom jenis kelamin harus dipilih!',
            'gender.integer' => 'Kolom jenis kelamin harus berupa angka!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Kolom tahun awal masuk harus diisi!',
            'school_year_start.integer' => 'Kolom tahun awal masuk harus berupa angka!',
            'school_year_start.digits' => 'Kolom tahun awal masuk harus 4 digit!',

            'school_year_end.required' => 'Kolom tahun akhir keluar harus diisi!',
            'school_year_end.integer' => 'Kolom tahun akhir keluar harus berupa angka!',
            'school_year_end.digits' => 'Kolom tahun akhir keluar harus 4 digit!',
            'school_year_end.gte' => 'Tahun akhir keluar harus lebih besar atau sama dengan tahun awal masuk!',
        ];
    }
}
