<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdministratorRepository extends Controller
{
    private $model, $query_builder_model;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->query_builder_model = DB::table('users');
    }

    /**
     * Ambil data administrator dari tabel users pada database.
     *
     * @param string $column adalah kolom field dari tabel users
     * @param string $direction adalah pengurutan data, default ASC atau ascending.
     * @return Object
     */
    public function administratorsOrderBy(string $column, string $direction = 'asc'): Object
    {
        return $this->query_builder_model->orderBy($column, $direction);
    }

    /**
     * Ambil single data dari tabel users berdasarkan id.
     *
     * @param object $jurusan adalah model binding dari model User.
     * @return Object
     */
    public function findAdministrator(object $administrator): Object
    {
        return $administrator;
    }

    public function update(Request $request, object $administrator): Bool
    {
        $this->model = $this->findAdministrator($administrator);
        return $this->model->update(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
    }

    /**
     * Menambah data administrator ke tabel users pada database.
     *
     * @param Request $request
     * @return Object
     */
    public function store(Request $request): Object
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }
}
