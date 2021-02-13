<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use DB;
use Illuminate\Http\Request;

class SchoolMajorRepository extends Controller
{
    private $model, $query_builder_model;
    public function __construct(SchoolMajor $model)
    {
        $this->model = $model;
        $this->query_builder_model = DB::table('school_majors');
    }

    /**
     * Ambil data dari tabel school_majors dengan eloquent orderBy.
     *
     * @param string $column adalah kolom dari tabel di database.
     * @param string $direction adalah pengurutannya, secara default akan terisi ASC atau ascending.
     * @return Object
     */
    public function schoolMajorsOrderBy(string $column, string $direction = 'asc'): Object
    {
        return $this->query_builder_model->orderBy($column, $direction);
    }

    /**
     * Ambil single data dari tabel school_majors pada database berdasarkan id.
     *
     * @param string $id adalah id dari school_major sesuai dengan di parameter.
     * @return Object
     */
    public function findSchoolMajor(string $id): Object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Simpan data jurusan ke tabel school_majors.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return $this->model->create($request->only('name', 'abbreviated_word'));
    }

    /**
     * Ubah data dari tabel school_majors pada database berdasarkan id.
     *
     * @param Request $request
     * @param string $id adalah id dari school_major sesuai dengan di parameter.
     * @return Bool
     */
    public function update(Request $request, string $id): Bool
    {
        $this->model = $this->findSchoolMajor($id);

        return $this->model->update($request->only('name', 'abbreviated_word'));
    }
}
