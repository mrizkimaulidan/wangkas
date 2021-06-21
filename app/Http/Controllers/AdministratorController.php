<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorStoreRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdministratorController extends Controller
{
    public function index(): View
    {
        $administrators = User::select('id', 'name', 'email', 'created_at')->orderBy('name')->get();

        return view('administrator.index', compact('administrators'));
    }

    public function store(AdministratorStoreRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('administrator.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $administrator = User::findOrFail($id);

        $administrator->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password === null ? $administrator->password : bcrypt($request->password)
        ]);

        return redirect()->route('administrator.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id): RedirectResponse
    {
        User::findOrFail($id)->delete();

        return redirect()->route('administrator.index')->with('success', 'Data berhasil dihapus!');
    }
}
