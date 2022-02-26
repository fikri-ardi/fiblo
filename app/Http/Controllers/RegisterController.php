<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.index');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:8|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        return redirect('login')->with(['message' => 'Registrasi kamu berhasil! silahkan login', 'type' => 'success']);
    }
}