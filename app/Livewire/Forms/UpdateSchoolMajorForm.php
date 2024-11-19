<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolMajorForm extends Form
{
    public ?SchoolMajor $schoolMajor;

    #[Validate]
    public ?string $name;

    public ?string $abbreviation;

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();
        $this->schoolMajor->update($this->all());

        $this->reset();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'abbreviation' => [
                'required',
                'max:255',
                Rule::unique('school_majors')->ignore($this->schoolMajor),
            ],
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
