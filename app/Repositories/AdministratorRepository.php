<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministratorRepository extends Controller
{
    public function __construct(
        private User $model
    ) {
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
        return $this->model->orderBy($column, $direction);
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
