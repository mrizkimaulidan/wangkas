<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $administrators = User::select('id', 'name', 'email', 'created_at')->orderBy('name')->get();

        if (request()->ajax()) {
            return datatables()->of($administrators)
                ->addIndexColumn()
                ->addColumn('created_at', fn ($model) => date('d-m-Y H:i', strtotime($model->created_at)))
                ->addColumn('action', 'administrators.datatable.action')
                ->toJson();
        }

        return view('administrators.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdministratorStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdministratorStoreRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('administrators.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $administrator): RedirectResponse
    {
        $administrator->update([
            'name' => $request->name,
            'email' => $request->email,

            // Jika inputan password kosong, isikan password yang sekarang, jika tidak kosong, isikan sesuai password di inputan
            // dan lakukan enkripsi.
            'password' => is_null($request->password) ? $administrator->password : bcrypt($request->password)
        ]);

        return redirect()->route('administrators.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $administrator): RedirectResponse
    {
        $administrator->delete();

        return redirect()->route('administrators.index')->with('success', 'Data berhasil dihapus!');
    }
}
