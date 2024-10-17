<?php

namespace App\Livewire\Forms;

use App\Models\SchoolClass;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolClassForm extends Form
{
    public string $id;

    #[Validate]
    public ?string $name;

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();

        SchoolClass::find($this->id)->update($this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('school_classes')->ignore($this->id),
            ],
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
