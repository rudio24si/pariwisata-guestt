<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Warga;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homestays = Homestay::all();
        return view('pages.homestay.index', compact('homestays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::orderBy('nama')->get(['warga_id', 'nama', 'no_ktp']);
        return view('pages.homestay.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemilik_warga_id' => 'nullable|exists:warga,warga_id',
            'nama' => 'required|string|max:200',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'fasilitas_json' => 'nullable|json',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Homestay::create($validated);

        return redirect()->route('homestay.index')->with('success', 'Homestay berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Homestay $homestay)
    {
        // Load relasi pemilik dengan data yang dibutuhkan
        $homestay->load([
            'pemilik' => function ($query) {
                $query->select('warga_id', 'nama', 'no_ktp', 'telp', 'email');
            }
        ]);

        return view('pages.homestay.show', compact('homestay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homestay $homestay)
    {
        $warga = Warga::orderBy('nama')->get(['warga_id', 'nama', 'no_ktp']);
        return view('pages.homestay.edit', compact('homestay', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Homestay $homestay)
    {
        $validated = $request->validate([
            'pemilik_warga_id' => 'nullable|exists:warga,warga_id',
            'nama' => 'required|string|max:200',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'fasilitas_json' => 'nullable|json',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $homestay->update($validated);

        return redirect()->route('homestay.index')->with('success', 'Homestay berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homestay $homestay)
    {
        $homestay->delete();

        return redirect()->route('homestay.index')->with('success', 'Homestay berhasil dihapus!');
    }
}