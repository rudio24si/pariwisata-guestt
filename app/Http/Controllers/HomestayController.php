<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Homestay::query();

        // 1. Fitur Search Berdasarkan Nama
        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        // 2. Fitur Filter Berdasarkan Harga
        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('harga_per_malam', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('harga_per_malam', 'desc');
            }
        } else {
            $query->latest(); // Default urutan terbaru jika tidak ada filter
        }
        $homestays = $query->paginate(6)->withQueryString();

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
            'status' => 'required|in:aktif,nonaktif',
            'filename' => 'required|array',
            'filename.*' => 'image|mimes:jpg,jpeg,png|max:2000'
        ]);

        // 1. Simpan Homestay
        $homestay = Homestay::create($validated);

        // 2. Simpan Foto ke Tabel Media
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                // Tambahkan ke database melalui model Media
                // Pastikan Anda sudah mengimpor use App\Models\Media; di atas
                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $homestay->homestay_id, // Mengambil ID homestay yang baru dibuat
                    'ref_table' => 'homestay',            // MENGATASI ERROR Gambar 2
                ]);
            }
        }

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
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'filename.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2000',
            'delete_media' => 'nullable|array',
        ]);

        // 1. Update data homestay
        $homestay->update($validated);

        // 2. Hapus foto yang dipilih (jika ada)
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    // Hapus file fisik
                    if (file_exists(public_path('images/' . $media->file_name))) {
                        unlink(public_path('images/' . $media->file_name));
                    }
                    $media->delete();
                }
            }
        }

        // 3. Tambah foto baru (jika ada)
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                \App\Models\Media::create([
                    'file_name' => $filename,
                    'ref_id' => $homestay->homestay_id,
                    'ref_table' => 'homestay', // Penting agar relasi sinkron
                ]);
            }
        }

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