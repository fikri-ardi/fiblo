<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register', ['user' => new User()]);
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->all());
        return to_route('verification.notice')->with('message', 'Registrasi kamu berhasil!');
    }
}