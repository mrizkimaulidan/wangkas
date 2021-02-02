<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;

class SchoolMajorRepository extends Controller
{
    public function __construct(
        private SchoolMajor $model
    ) {
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
        return $this->model->orderBy($column, $direction);
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
}
