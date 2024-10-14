<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolMajorForm extends Form
{
    public string $id;

    #[Validate]
    public string $name = '';

    public string $abbreviation = '';

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();

        SchoolMajor::find($this->id)->update($this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'abbreviation' => [
                'required',
                'max:255',
                Rule::unique('school_majors')->ignore($this->id),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
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
