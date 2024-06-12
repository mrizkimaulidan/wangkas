<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile_settings.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(auth()->id());
        $validated = $request->validated();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => !is_null($validated['password']) ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('profile-settings.index')->with('success', 'Data berhasil diubah!');
    }
}
