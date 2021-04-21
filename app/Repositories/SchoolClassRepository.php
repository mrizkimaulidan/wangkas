<?php

namespace App\Repositories;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolClass\StoreSchoolClassRequest;

class SchoolClassRepository extends Controller
{
    private $model, $query_builder_model;

    public function __construct(SchoolClass $model)
    {
        $this->model = $model;
        $this->query_builder_model = DB::table('school_classes');
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
        return $this->query_builder_model->orderBy($column, $direction);
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
     * @param string $id adalah id dari model SchoolClass.
     * @return Object
     */
    public function findSchoolClass(string $id): Object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Ubah data kelas berdasarkan id.
     *
     * @param Request $request adalah isi dari request user.
     * @param string $id adalah id dari model SchoolClass.
     * @return Bool
     */
    public function update(Request $request, string $id): Bool
    {
        $this->model = $this->findSchoolClass($id);

        return $this->model->update($request->only('name'));
    }
}
