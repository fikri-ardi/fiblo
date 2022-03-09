<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register.index', ['user' => new User()]);
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->all());
        return redirect('login')->with(['message' => 'Registrasi kamu berhasil! silahkan login', 'type' => 'success']);
    }
}