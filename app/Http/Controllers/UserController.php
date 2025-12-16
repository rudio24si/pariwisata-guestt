<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }


    public function create()
    {
        return view('pages.user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('user.index');
    }


    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);


        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }


        $user->update($data);
        return redirect()->route('user.index');
    }
    
    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}