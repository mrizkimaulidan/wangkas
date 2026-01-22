<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreSchoolMajorForm extends Form
{
    #[Validate]
    public string $name = '';

    public string $abbreviation = '';

    /**
     * Save new data to database
     */
    public function store(): void
    {
        $this->validate();

        SchoolMajor::create($this->only('name', 'abbreviation'));

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
            'abbreviation' => [
                'required',
                'string',
                'min:1',
                'max:255',
                'unique:school_majors,abbreviation',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama jurusan harus diisi!',
            'name.string' => 'Kolom nama jurusan harus berupa karakter!',
            'name.min' => 'Kolom nama jurusan minimal :min karakter!',
            'name.max' => 'Kolom nama jurusan maksimal :max karakter!',
            'name.unique' => 'Nama kelas sudah digunakan!',

            'abbreviation.required' => 'Kolom singkatan jurusan harus diisi!',
            'abbreviation.string' => 'Kolom singkatan jurusan harus berupa karakter!',
            'abbreviation.min' => 'Kolom singkatan jurusan minimal :min karakter!',
            'abbreviation.max' => 'Kolom singkatan jurusan maksimal :max karakter!',
            'abbreviation.unique' => 'Singkatan jurusan sudah digunakan!',
        ];
    }
}
