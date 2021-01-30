<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentRepository extends Controller
{
    public function __construct(
        private Student $model
    ) {
    }

    /**
     * Ambil data siswa dari tabel students dengan eloquent orderBy.
     *
     * @param string $column adalah kolom dari tabel di database.
     * @param string $direction adalah pengurutannya, secara default akan terisi ASC atau ascending.
     * @return Object
     */
    public function studentsOrderBy(string $column, string $direction = 'asc'): Object
    {
        return $this->model->orderBy($column, $direction);
    }

    /**
     * Simpan data siswa ke tabel students pada database.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return $this->model->create($request->only('school_class_id', 'school_major_id', 'name', 'email', 'phone_number', 'gender', 'school_year_start', 'school_year_end'));
    }
}
