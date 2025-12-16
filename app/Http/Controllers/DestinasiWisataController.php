<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use Illuminate\Http\Request;

class DestinasiWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DestinasiWisata::with('ulasan');

        // Fitur Search berdasarkan Nama
        if ($request->filled('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        // Fitur Filter berdasarkan Harga
        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('tiket', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('tiket', 'desc');
            }
        } else {
            $query->latest(); // Default urutan terbaru
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
            'rt' => 'nullable|max:3',
            'rw' => 'nullable|max:3',
            'jam_buka' => 'nullable|date_format:H:i',
            'jam_tutup' => 'nullable|date_format:H:i|after:jam_buka',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'nullable|max:20'
        ]);

        DestinasiWisata::create($request->all());

        return redirect()->route('destinasi-wisata.index')
            ->with('success', 'Destinasi wisata berhasil ditambahkan!');
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
            'deskripsi' => 'nullable',
            'alamat' => 'required',
            'rt' => 'nullable|max:3',
            'rw' => 'nullable|max:3',
            'jam_buka' => 'nullable|date_format:H:i',
            'jam_tutup' => 'nullable|date_format:H:i|after:jam_buka',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'nullable|max:20'
        ]);

        $destinasi->update($request->all());

        return redirect()->route('destinasi-wisata.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui!');
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