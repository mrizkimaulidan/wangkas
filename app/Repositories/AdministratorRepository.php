<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\User;

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
}
