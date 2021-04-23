<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorStoreRequest;
use App\Http\Requests\AdministratorUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $administrators = User::select('id', 'name', 'email', 'created_at')->orderBy('name')->get();

        return view('administrator.index', compact('administrators'));
    }

    public function store(AdministratorStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('administrator.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $administrator = User::findOrFail($id);

        $administrator->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password === null ? $administrator->password : bcrypt($request->password)
        ]);

        return redirect()->route('administrator.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('administrator.index')->with('success', 'Data berhasil dihapus!');
    }
}
