<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolClass\StoreSchoolClassRequest;
use App\Models\SchoolClass;
use DB;
use Illuminate\Http\Request;

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
     * @param object $kela adalah model binding dari model SchoolMajor.
     * @return Object
     */
    public function findSchoolClass(object $kela): Object
    {
        return $kela;
    }

    /**
     * Ubah data kelas berdasarkan id.
     *
     * @param Request $request adalah is dari input type name.
     * @param object $kela adalah model binding dari model SchoolClass.
     * @return Bool
     */
    public function update(Request $request, object $kela): Bool
    {
        $this->model = $this->findSchoolClass($kela);

        return $this->model->update($request->only('name'));
    }
}
