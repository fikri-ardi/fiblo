<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\PostStatus;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // // Use unsplash API
        // // Configuration
        // \Unsplash\HttpClient::init([
        //     'applicationId'    => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
        //     'secret'    => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
        //     'callbackUrl'    => 'http://fiblo.test/',
        //     'utmSource' => 'Fiblo'
        // ]);

        // // Get some random photos
        // $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];
        $photos = env('DUMMY_IMAGE');

        $posts = $user->posts()->postState(PostStatus::Published)->latest()->paginate(6);
        return view('profiles.show', compact('user', 'posts', 'photos'));
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
        if (auth()->id() !== $user->id) {
            auth()->user()->wasFollow($user) ? auth()->user()->unfollow($user) : auth()->user()->follow($user);
        }

        return back();
    }
}