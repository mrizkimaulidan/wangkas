<?php

namespace App\Http\Controllers;

use App\Repositories\AdministratorRepository;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function __construct(
        private AdministratorRepository $administratorRepository
    ) {
    }

    public function index()
    {
        return view('administrator.index', [
            'administrators' => $this->administratorRepository->administratorsOrderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->administratorRepository->store($request);

        return redirect()->route('administrator.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->administratorRepository->update($request, $id);

        return redirect()->route('administrator.index')->with('sucess', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $this->administratorRepository->findAdministrator($id)->delete();

        return redirect()->route('administrator.index')->with('success', 'Data berhasil dihapus!');
    }
}
