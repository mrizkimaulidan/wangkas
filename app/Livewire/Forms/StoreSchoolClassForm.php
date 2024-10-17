<?php

namespace App\Livewire\Forms;

use App\Models\SchoolClass;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreSchoolClassForm extends Form
{
    #[Validate]
    public ?string $name;

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        $this->validate();

        SchoolClass::create($this->pull());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:school_classes,name',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kelas tidak boleh kosong!',
            'name.max' => 'Nama kelas harus maksimal :max karakter!',
            'name.unique' => 'Nama kelas sudah terdaftar!',
        ];
    }
}
