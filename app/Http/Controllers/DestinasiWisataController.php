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
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,jpeg,png|max:3000'
        ]);

        $destinasi = DestinasiWisata::create($request->all());

        if ($request->hasFile('filename')) {
            $filesData = [];

            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
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

        $request->validate([
            'nama' => 'required|max:150',
            'tiket' => 'required|numeric',
            'filename.*' => 'nullable|mimes:jpg,jpeg,png|max:3000'
        ]);

        $destinasi->update($request->all());

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