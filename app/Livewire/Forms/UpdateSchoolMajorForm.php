<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolMajorForm extends Form
{
    public SchoolMajor $schoolMajor;

    #[Validate]
    public string $name;

    public string $abbreviation;

    /**
     * Update data to database
     */
    public function update(): void
    {
        $this->validate();
        $this->schoolMajor->update($this->all());
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
                Rule::unique('school_majors', 'abbreviation')->ignore($this->schoolMajor),
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
