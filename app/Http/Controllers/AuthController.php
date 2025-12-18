<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $user = User::where('name', $data['name'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['name' => 'Username atau password salah'])->withInput();
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Login berhasil');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function registerPost(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8,regex:/[A-Z]/',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Pelanggan'
        ]);

        Auth::login($user);

        return redirect()->intended('/');
    }
}
