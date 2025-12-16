<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['name', 'email'];

        $users = User::search($request, $searchableColumns)
            ->paginate(8)
            ->withQueryString();
        return view('pages.user.index', compact('users'));
    }


    public function create()
    {
        return view('pages.user.create');
    }


    public function store(Request $request)
    {
        // 1. Validasi dengan pesan kustom
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:super_admin,pelanggan,mitra',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi!',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // 2. Siapkan data untuk disimpan
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // 3. Logika Upload Foto
        if ($request->hasFile('profile_picture')) {
            // Simpan ke folder 'profile_pictures' di disk 'public'
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        // 4. Create User
        User::create($data);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan dengan foto profil!');
    }


    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:8|confirmed',
                'role' => 'required|in:Super Admin,Pelanggan,Mitra',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi ya!',
                'email.required' => 'Alamat email tidak boleh kosong.',
                'email.email' => 'Format email yang Anda masukkan tidak valid.',
                'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain.',
                'password.min' => 'Password minimal harus 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'profile_picture.image' => 'File harus berupa gambar.',
                'profile_picture.mimes' => 'Format gambar yang diperbolehkan hanya: jpeg, png, jpg, gif.',
                'profile_picture.max' => 'Ukuran gambar terlalu besar, maksimal 2MB.',
            ]
        );

        $data = $request->only('name', 'email', 'role');

        // Hash password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Cek jika ada file gambar baru yang diunggah
        if ($request->hasFile('profile_picture')) {
            // 1. Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // 2. Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // 3. Masukkan path ke dalam array data untuk diupdate
            $data['profile_picture'] = $path;
        }

        // Update semua data sekaligus
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Profil berhasil diperbarui');
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