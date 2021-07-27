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

        return view('administrators.index', compact('administrators'));
    }

    public function store(AdministratorStoreRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('administrators.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, User $administrator): RedirectResponse
    {
        $administrator->update([
            'name' => $request->name,
            'email' => $request->email,

            // Jika inputan password kosong, isikan password yang sekarang, jika tidak kosong, isikan sesuai password di inputan
            // dan lakukan enkripsi.
            'password' => $request->password === null ? $administrator->password : bcrypt($request->password)
        ]);

        return redirect()->route('administrators.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(User $administrator): RedirectResponse
    {
        $administrator->delete();

        return redirect()->route('administrators.index')->with('success', 'Data berhasil dihapus!');
    }
}
