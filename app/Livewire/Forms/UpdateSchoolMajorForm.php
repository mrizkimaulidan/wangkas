<?php

namespace App\Livewire\Forms;

use App\Models\SchoolMajor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateSchoolMajorForm extends Form
{
    public string $id;

    #[Validate]
    public string $name = '';

    public string $abbreviation = '';

    public function update()
    {
        $this->validate();

        SchoolMajor::find($this->id)->update($this->all());
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'abbreviation' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama jurusan tidak boleh kosong!',
            'name.min' => 'Kolom nama jurusan minimal :min karakter!',
            'name.max' => 'Kolom nama jurusan maksimal :max karakter!',

            'abbreviation.required' => 'Kolom singkatan jurusan tidak boleh kosong!',
            'abbreviation.min' => 'Kolom singkatan jurusan minimal :min karakter!',
            'abbreviation.max' => 'Kolom singkatan jurusan maksimal :max karakter!',
        ];
    }
}
