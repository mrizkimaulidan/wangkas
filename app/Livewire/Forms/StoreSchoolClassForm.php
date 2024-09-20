<?php

namespace App\Livewire\Forms;

use App\Models\SchoolClass;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreSchoolClassForm extends Form
{
    #[Validate]
    public string $name = '';

    public function store()
    {
        $this->validate();

        SchoolClass::create($this->pull());
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama kelas tidak boleh kosong!',
            'name.min' => 'Kolom nama kelas minimal :min karakter!',
            'name.max' => 'Kolom nama kelas maksimal :max karakter!',
        ];
    }
}