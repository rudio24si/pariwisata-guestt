<?php

namespace App\Http\Controllers;

use App\Models\BookingHomestay;
use App\Models\KamarHomestay;
use App\Models\Warga;
use App\Models\Home;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ambil kamar_id dari query string atau form sebelumnya
        $kamar_id = $request->input('kamar_id');

        if (!$kamar_id) {
            // Redirect ke halaman pilih kamar jika tidak ada kamar_id
            return redirect()->route('homestay.index')
                ->with('error', 'Silakan pilih kamar terlebih dahulu.');
        }

        $kamar = KamarHomestay::with('homestay')->findOrFail($kamar_id);
        $warga = Warga::all();

        return view('pages.booking_homestay.create', compact('kamar', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required',
            'warga_id' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'metode_bayar' => 'required',
        ]);

        $kamar = KamarHomestay::findOrFail($request->kamar_id);
        $hargaPerMalam = $kamar->harga;

        $days = Carbon::parse($request->checkin)
            ->diffInDays(Carbon::parse($request->checkout));

        $total = $days * $hargaPerMalam;

        BookingHomestay::create([
            'kamar_id' => $request->kamar_id,
            'warga_id' => $request->warga_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total' => $total,
            'status' => 'pending',
            'metode_bayar' => $request->metode_bayar,
        ]);

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->load(['kamar.homestay', 'warga']);
        return view('pages.booking_homestay.show', compact('bookingHomestay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingHomestay $bookingHomestay)
    {
        $kamars = KamarHomestay::whereHas('homestay', function ($query) {
            $query->where('status', 'aktif');
        })->with('homestay')->get();

        $wargas = Warga::orderBy('nama')->get(['warga_id', 'nama', 'no_ktp']);

        return view('pages.booking_homestay.edit', compact('bookingHomestay', 'kamars', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingHomestay $bookingHomestay)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'metode_bayar' => 'nullable|in:tunai,transfer,qris,kredit',
            'catatan' => 'nullable|string|max:500',
            'total' => 'required|numeric|min:0'
        ]);

        // Hitung jumlah malam jika tanggal berubah
        if ($validated['checkin'] != $bookingHomestay->checkin || $validated['checkout'] != $bookingHomestay->checkout) {
            $checkin = Carbon::parse($validated['checkin']);
            $checkout = Carbon::parse($validated['checkout']);
            $validated['jumlah_malam'] = $checkout->diffInDays($checkin);
        }

        $bookingHomestay->update($validated);

        return redirect()->route('booking-homestay.show', $bookingHomestay->booking_id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->delete();

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Action untuk konfirmasi booking
     */
    public function confirm(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->update(['status' => 'confirmed']);

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi!');
    }

    /**
     * Action untuk check-in
     */
    public function checkin(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->update(['status' => 'checked_in']);

        return redirect()->back()->with('success', 'Check-in berhasil!');
    }

    /**
     * Action untuk check-out
     */
    public function checkout(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->update(['status' => 'checked_out']);

        return redirect()->back()->with('success', 'Check-out berhasil!');
    }

    /**
     * Action untuk batalkan booking
     */
    public function cancel(BookingHomestay $bookingHomestay)
    {
        $bookingHomestay->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan!');
    }
}