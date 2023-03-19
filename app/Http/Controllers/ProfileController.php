<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\PostStatus;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->postState(PostStatus::Published)->latest()->paginate(6);
        return view('profiles.show', compact('user', 'posts'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', [
            'user' => $user,
            'links' => $user->links
        ]);
    }

    public function update(ProfileRequest $request, User $user)
    {
        $request->update($user);
        return to_route('profiles.show', compact('user'))->with('message', 'Profil kamu berhasil diupdate :)');
    }

    public function follow(User $user)
    {
        $action = auth()->user()->wasFollow($user) ? 'unfollow' : 'follow';
        auth()->user()->wasFollow($user) ? auth()->user()->unfollow($user) : auth()->user()->follow($user);

        return back();
    }
}