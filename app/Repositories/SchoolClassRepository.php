<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolClass\StoreSchoolClassRequest;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassRepository extends Controller
{
    public function __construct(
        private SchoolClass $model
        // model $model
    ) {
    }

    /**
     * Ambil data dari tabel school_classes dengan eloquent orderBy.
     *
     * @param string $column adalah kolom dari tabel di database.
     * @param string $direction adalah pengurutannya, secara default akan terisi ASC atau ascending.
     * @return Object
     */
    public function schoolClassesOrderBy(string $column, string $direction = 'asc'): Object
    {
        return $this->model->orderBy($column, $direction);
    }

    /**
     * Simpan data kelas ke tabel school_classes pada database.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return $this->model->create($request->only('name'));
    }

    /**
     * Ambil data kelas dari tabel school_classes
     *
     * @param string $id
     * @return Object
     */
    public function findSchoolClass(string $id): Object
    {
        return $this->model->findOrFail($id);
    }

    public function update(Request $request, $id): Bool
    {
        $this->model = $this->findSchoolClass($id);

        return $this->model->update($request->only('name'));
    }
}
