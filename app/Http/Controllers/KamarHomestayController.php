<?php

namespace App\Http\Controllers;

use App\Models\KamarHomestay;
use App\Models\Homestay;
use App\Models\Media;
use Illuminate\Http\Request;

class KamarHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KamarHomestay::with(['media', 'homestay']);

        if ($request->filled('search')) {
            $query->where('nama_kamar', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('harga', 'desc');
            }
        } else {
            $query->latest();
        }

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
            'harga' => 'required|numeric|min:0',
            'filename' => 'required|array',
            'filename.*' => 'image|mimes:jpg,jpeg,png|max:2000'
        ]);

        $kamarHomestay = KamarHomestay::create($validated);

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $kamarHomestay->kamar_id,
                    'ref_table' => 'kamar_homestay',
                ]);
            }
        }
        return redirect()->route('kamar-homestay.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KamarHomestay $kamarHomestay)
    {
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
            'harga' => 'required|numeric|min:0',
            'filename.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2000',
            'delete_media' => 'nullable|array',
        ]);

        $kamarHomestay->update($validated);

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images'), $filename);

                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $kamarHomestay->kamar_id,
                    'ref_table' => 'kamar_homestay',
                ]);
            }
        }
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