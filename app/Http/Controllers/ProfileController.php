<?php

namespace App\Http\Controllers;

use App\Models\{Role, User};
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
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
        $user->update($request->all());
        return back()->with(['message' => 'Profil kamu berhasil diupdate :)', 'type' => 'success']);
    }

    public function follow(User $user)
    {
        $action = auth()->user()->wasFollow($user) ? 'unfollow' : 'follow';
        auth()->user()->wasFollow($user) ? auth()->user()->unfollow($user) : auth()->user()->follow($user);
        return back()->with(['message' => "Kamu berhasil $action $user->name"]);
    }
}