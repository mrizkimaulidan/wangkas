<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreSchoolMajorForm extends Form
{
    #[Validate]
    public ?string $name;

    public ?string $abbreviation;

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        $this->validate();

        SchoolMajor::create($this->pull());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255|unique:school_majors,abbreviation',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama jurusan tidak boleh kosong!',
            'name.max' => 'Nama jurusan harus maksimal :max karakter!',

            'abbreviation.required' => 'Singkatan jurusan tidak boleh kosong!',
            'abbreviation.max' => 'Singkatan jurusan harus maksimal :max karakter!',
            'abbreviation.unique' => 'Singkatan jurusan sudah terdaftar!',
        ];
    }
}
