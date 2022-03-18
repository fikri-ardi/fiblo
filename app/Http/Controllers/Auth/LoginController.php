<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login', ['user' => new User()]);
    }

    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials,  request('remember') ? true : false)) {
            request()->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->with(['message' => 'Maaf, data yang kamu masukin ngga cocok', 'type' => 'danger']);
    }

    public function logout()
    {
        Auth::logout();

        // agar masa sessionnya habis, jadi ngga bisa digunakan lagi 
        request()->session()->invalidate();

        // buat token session baru lagi 
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}