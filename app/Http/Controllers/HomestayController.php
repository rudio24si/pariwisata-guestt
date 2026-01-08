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

        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('harga_per_malam', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('harga_per_malam', 'desc');
            }
        } else {
            $query->latest(); 
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
            'filename.*' => 'image|mimes:jpg,jpeg,png|max:4000'
        ]);

        $homestay = Homestay::create($validated);

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $homestay->homestay_id, 
                    'ref_table' => 'homestay',            
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
            'filename.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4000',
            'delete_media' => 'nullable|array',
        ]);

        $homestay->update($validated);

        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    if (file_exists(public_path('images/' . $media->file_name))) {
                        unlink(public_path('images/' . $media->file_name));
                    }
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                \App\Models\Media::create([
                    'file_name' => $filename,
                    'ref_id' => $homestay->homestay_id,
                    'ref_table' => 'homestay',
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