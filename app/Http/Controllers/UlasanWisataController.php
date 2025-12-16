<?php

namespace App\Http\Controllers;

use App\Models\UlasanWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanWisataController extends Controller
{
    /**
     * Menyimpan ulasan baru dari pengunjung
     */
    public function store(Request $request)
    {
        // dd($request->destinasi_id);
        $request->validate([
            'destinasi_id' => 'required|exists:destinasi_wisata,destinasi_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        UlasanWisata::create([
            'destinasi_id' => $request->destinasi_id,
            'warga_id' => Auth::id(), // Mengambil ID user yang sedang login
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'waktu' => now(), // Mengisi kolom waktu dengan timestamp saat ini
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        $ulasan = UlasanWisata::findOrFail($id);

        // Pastikan hanya pemilik ulasan yang bisa edit (opsional)
        // if($ulasan->warga_id != auth()->id()) return back();

        $ulasan->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'waktu' => now(), // Update waktu jika ingin memperbarui timestamp
        ]);

        return back()->with('success', 'Ulasan diperbarui!');
    }
    /**
     * Menghapus ulasan (jika diperlukan untuk admin)
     */
    public function destroy(UlasanWisata $ulasan)
    {
        $ulasan->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}