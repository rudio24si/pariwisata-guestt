<?php

namespace App\Http\Controllers;

use App\Models\KamarHomestay;
use App\Models\Homestay;
use Illuminate\Http\Request;

class KamarHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil query dasar beserta relasi homestay agar tidak N+1 query
        $query = KamarHomestay::with('homestay');

        // 1. Fitur Search berdasarkan Nama Kamar
        if ($request->filled('search')) {
            $query->where('nama_kamar', 'LIKE', '%' . $request->search . '%');
        }

        // 2. Fitur Filter berdasarkan Harga
        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('harga', 'desc');
            }
        } else {
            $query->latest(); // Default urutan terbaru
        }

        // 3. Pagination (6 data per halaman)
        // withQueryString() menjaga agar filter tetap aktif saat pindah halaman pagination
        $kamars = $query->paginate(6)->withQueryString();

        return view('pages.kamar_homestay.index', compact('kamars'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homestays = Homestay::where('status', 'aktif')
            ->orderBy('nama')
            ->get(['homestay_id', 'nama']);

        return view('pages.kamar_homestay.create', compact('homestays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1|max:10',
            'fasilitas_json' => 'nullable|json',
            'harga' => 'required|numeric|min:0'
        ]);

        KamarHomestay::create($validated);

        return redirect()->route('kamar-homestay.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KamarHomestay $kamarHomestay)
    {
        // Eager load homestay dengan data yang diperlukan
        $kamarHomestay->load([
            'homestay' => function ($query) {
                $query->select('homestay_id', 'nama', 'alamat', 'rt', 'rw', 'status');
            }
        ]);

        return view('pages.kamar_homestay.show', compact('kamarHomestay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KamarHomestay $kamarHomestay)
    {
        $homestays = Homestay::where('status', 'aktif')
            ->orderBy('nama')
            ->get(['homestay_id', 'nama']);

        return view('pages.kamar_homestay.edit', compact('kamarHomestay', 'homestays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KamarHomestay $kamarHomestay)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1|max:10',
            'fasilitas_json' => 'nullable|json',
            'harga' => 'required|numeric|min:0'
        ]);

        $kamarHomestay->update($validated);

        return redirect()->route('kamar-homestay.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KamarHomestay $kamarHomestay)
    {
        $kamarHomestay->delete();

        return redirect()->route('kamar-homestay.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}