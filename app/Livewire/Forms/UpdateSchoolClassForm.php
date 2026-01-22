<?php

namespace App\Livewire\Forms;

use App\Models\SchoolClass;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolClassForm extends Form
{
    public SchoolClass $schoolClass;

    #[Validate]
    public string $name;

    /**
     * Update data to database
     */
    public function update(): void
    {
        $this->validate();
        $this->schoolClass->update($this->all());
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
                Rule::unique('school_classes', 'name')->ignore($this->schoolClass),
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama kelas harus diisi!',
            'name.string' => 'Kolom nama kelas harus berupa karakter!',
            'name.min' => 'Kolom nama kelas minimal :min karakter!',
            'name.max' => 'Kolom nama kelas maksimal :max karakter!',
            'name.unique' => 'Nama kelas sudah digunakan!',
        ];
    }
}
