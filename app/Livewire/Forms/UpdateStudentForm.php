<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateStudentForm extends Form
{
    public ?Student $student;

    #[Validate]
    public ?string $identification_number;

    public ?string $name;

    public ?string $phone_number;

    public ?string $gender;

    public ?string $school_class_id;

    public ?string $school_major_id;

    public ?string $school_year_start;

    public ?string $school_year_end;

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();
        $this->student->update($this->all());

        $this->reset();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'school_class_id' => 'required|exists:school_classes,id',
            'school_major_id' => 'required|exists:school_majors,id',
            'identification_number' => [
                'required',
                'numeric',
                Rule::unique('students')->ignore($this->student),
            ],
            'name' => 'required|string|min:3|max:255',
            'phone_number' => [
                'required',
                'digits_between:8,15',
                Rule::unique('students')->ignore($this->student),
            ],
            'gender' => 'required|in:1,2',
            'school_year_start' => 'required|digits:4',
            'school_year_end' => 'required|digits:4',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'school_class_id.required' => 'Kelas tidak boleh kosong!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak valid!',

            'school_major_id.required' => 'Jurusan tidak boleh kosong!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak valid!',

            'identification_number.required' => 'Nomor identitas tidak boleh kosong!',
            'identification_number.numeric' => 'Nomor identitas harus berupa angka!',
            'identification_number.unique' => 'Nomor identitas sudah terdaftar!',

            'name.required' => 'Nama lengkap tidak boleh kosong!',
            'name.string' => 'Nama lengkap harus berupa teks!',
            'name.min' => 'Nama lengkap harus minimal :min karakter!',
            'name.max' => 'Nama lengkap harus maksimal :max karakter!',

            'phone_number.required' => 'Nomor telepon tidak boleh kosong!',
            'phone_number.digits_between' => 'Nomor telepon harus antara :min dan :max digit!',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar!',

            'gender.required' => 'Jenis kelamin tidak boleh kosong!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Tahun masuk tidak boleh kosong!',
            'school_year_start.digits' => 'Tahun masuk harus 4 digit!',

            'school_year_end.required' => 'Tahun lulus tidak boleh kosong!',
            'school_year_end.digits' => 'Tahun lulus harus 4 digit!',
        ];
    }
}
