<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KamarHomestay;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $query = KamarHomestay::query();

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
            $query->latest();
        }

        // 3. Pagination (Misal: 6 data per halaman)
        $kamars = $query->paginate(6)->withQueryString();

        return view('pages.booking_homestay.index', compact('kamars'));
    }
}
