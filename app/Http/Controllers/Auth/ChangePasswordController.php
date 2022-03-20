<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function change()
    {
        return view('auth.change-password');
    }
    public function update()
    {
        $validatedData = request()->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($validatedData['current_password'], auth()->user()->password)) {
            auth()->user()->update(request()->only('password'));
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('login')->with(['message' => 'Yay! kamu berhasil ganti password.', 'type' => 'success']);
        }

        return back()->withErrors(['current_password' => 'Maaf, Password yang kamu masukkin ngga cocok.']);
    }
}