<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class StudentRepository extends Controller
{
    private $model;
    private $relations = ['school_classes', 'school_majors'];

    public function __construct(Student $model)
    {
        $this->model = $model->with($this->relations);
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
     * Ambil data siswa dari table students dengan selected field saja dengan orderBy
     *
     * @param array $field adalah kolom/field apa saja dari tabel di database.
     * @param string $column adalah kolom/field dari tabel di database.
     * @param string $direction adalah pengurutannya, secara default akan terisi ASC atau ascending.
     * @return Object
     */
    public function getStudentsOnlySelectedFieldOrderBy(array $field, string $column, string $direction = 'asc'): Object
    {
        return $this->model->select($field)->orderBy($column, $direction);
    }

    /**
     * Ambil data siswa berdasarkan id dari tabel students pada database.
     *
     * @param object $id adalah model binding dari model Student.
     * @return Object
     */
    public function findStudent(object $pelajar): Object
    {
        return $pelajar;
    }

    /**
     * Simpan data siswa ke tabel students pada database.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return $this->model->create($request->only('student_identification_number', 'school_class_id', 'school_major_id', 'name', 'email', 'phone_number', 'gender', 'school_year_start', 'school_year_end'));
    }

    public function update(Request $request, object $pelajar): Bool
    {
        $this->model = $this->findStudent($pelajar);

        return $this->model->update($request->only('student_identification_number', 'school_class_id', 'school_major_id', 'name', 'email', 'phone_number', 'gender', 'school_year_start', 'school_year_end'));
    }
}
