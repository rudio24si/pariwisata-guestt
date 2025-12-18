<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\Media;
use Illuminate\Http\Request;

class DestinasiWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Tambahkan 'media' di sini
        $query = DestinasiWisata::with(['ulasan', 'media']);

        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('tiket', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('tiket', 'desc');
            }
        } else {
            $query->latest();
        }

        $destinasi = $query->paginate(6)->withQueryString();

        return view('pages.destinasi-wisata.index', compact('destinasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.destinasi-wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'deskripsi' => 'nullable',
            'alamat' => 'required',
            'tiket' => 'required|numeric|min:0',
            // Validasi file (disesuaikan dengan gambar referensi Anda)
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:3000'
        ]);

        // 1. Simpan Destinasi Utama
        $destinasi = DestinasiWisata::create($request->all());

        if ($request->hasFile('filename')) {
            $filesData = [];

            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    // Penamaan file (sesuai logika gambar Anda)
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $file->move(public_path('images'), $filename);


                    $filesData[] = [
                        'file_name' => $filename,
                        'ref_id' => $destinasi->destinasi_id,
                        'ref_table' => 'destinasi_wisata',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // 3. Simpan ke tabel media
            // Pastikan Modelnya sesuai (misal: Media atau FotoDestinasi)
            Media::insert($filesData);
        }

        return redirect()->route('destinasi-wisata.index')
            ->with('success', 'Berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        return view('pages.destinasi-wisata.show', compact('destinasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        return view('pages.destinasi-wisata.edit', compact('destinasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);

        // Validasi data
        $request->validate([
            'nama' => 'required|max:150',
            'tiket' => 'required|numeric',
            'filename.*' => 'nullable|mimes:jpg,jpeg,png|max:3000'
        ]);

        // Update data utama
        $destinasi->update($request->all());

        // A. Logika HAPUS foto yang diceklis
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    // Hapus file fisik dari folder public/images
                    if (file_exists(public_path('images/' . $media->file_name))) {
                        unlink(public_path('images/' . $media->file_name));
                    }
                    // Hapus record di database
                    $media->delete();
                }
            }
        }

        // B. Logika TAMBAH foto baru (sama seperti fungsi store)
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $destinasi->destinasi_id,
                    'ref_table' => 'destinasi_wisata',
                ]);
            }
        }

        return redirect()->route('destinasi-wisata.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = DestinasiWisata::find($id);

        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $data->delete();

        return redirect()->route('destinasi-wisata.index')
            ->with('success', 'Destinasi wisata berhasil dihapus!');
    }
}