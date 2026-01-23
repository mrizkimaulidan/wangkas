<?php

namespace App\Livewire\Forms;

use App\Models\SchoolClass;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreSchoolClassForm extends Form
{
    #[Validate]
    public string $name = '';

    /**
     * Save new data to database
     */
    public function store(): void
    {
        $this->validate();

        SchoolClass::create($this->only('name'));

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
                'unique:school_classes,name',
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
