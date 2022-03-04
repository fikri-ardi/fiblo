<?php

namespace App\Http\Controllers;

use App\Models\{Role, User};
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profiles.show', [
            'user' => auth()->user()
        ]);
    }

    public function edit(User $user)
    {
        return view('profiles.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(ProfileRequest $request, User $user)
    {
        $validatedData = $request->all();
        !$request->photo ?: $validatedData['photo'] = $request->photo->store('images/posts');
        $user->update($validatedData);

        return redirect('/profiles')->with(['message' => 'Profil kamu berhasil diupdate :)', 'type' => 'success']);
    }
}