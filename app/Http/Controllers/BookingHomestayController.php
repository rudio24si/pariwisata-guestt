<?php

namespace App\Http\Controllers;

use App\Models\BookingHomestay;
use App\Models\KamarHomestay;
use App\Models\Warga;
use App\Models\Media;
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
        // 1. Ambil data booking secara keseluruhan dengan relasi Kamar, Media, dan Warga (Penyewa)
        $query = BookingHomestay::with(['kamar.media', 'warga']);

        // 2. Fitur Search berdasarkan Nama Kamar atau Nama Warga
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('kamar', function ($inner) use ($request) {
                    $inner->where('nama_kamar', 'LIKE', '%' . $request->search . '%');
                })->orWhereHas('warga', function ($inner) use ($request) {
                    $inner->where('nama', 'LIKE', '%' . $request->search . '%');
                });
            });
        }

        // 3. Fitur Filter berdasarkan Urutan
        if ($request->filled('sort')) {
            if ($request->sort == 'terlama') {
                $query->orderBy('created_at', 'asc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        // 4. Pagination
        $bookings = $query->paginate(9)->withQueryString();

        return view('pages.booking_homestay.index', compact('bookings'));
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
        // 1. Validasi Input (Tambahkan validasi untuk filename)
        $request->validate([
            'kamar_id' => 'required',
            'warga_id' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'metode_bayar' => 'required',
            'filename' => 'nullable|array', // Input file berupa array
            'filename.*' => 'image|mimes:jpg,jpeg,png|max:2048' // Validasi tiap file
        ]);

        $kamar = KamarHomestay::findOrFail($request->kamar_id);
        $hargaPerMalam = $kamar->harga;

        // Hitung durasi menginap
        $days = \Carbon\Carbon::parse($request->checkin)
            ->diffInDays(\Carbon\Carbon::parse($request->checkout));

        $total = $days * $hargaPerMalam;

        // 2. Simpan Data Booking ke variabel agar kita bisa ambil ID-nya
        $booking = BookingHomestay::create([
            'kamar_id' => $request->kamar_id,
            'warga_id' => $request->warga_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total' => $total,
            'status' => 'pending',
            'metode_bayar' => $request->metode_bayar,
        ]);

        // 3. Simpan Bukti Pembayaran ke tabel Media (jika ada file)
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                // Buat nama file unik
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());

                // Pindahkan file ke folder public/images/pembayaran
                $file->move(public_path('images'), $filename);

                // Simpan ke tabel media
                Media::create([
                    'file_name' => $filename,
                    'ref_id' => $booking->booking_id, // Pastikan ini sesuai dengan Primary Key model Booking Anda
                    'ref_table' => 'booking_homestay',            // Penting: agar data tidak tertukar dengan foto kamar
                ]);
            }
        }

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = BookingHomestay::findOrFail($id);
        // $booking->load(['kamar.homestay', 'warga', 'media']);

        return view('pages.booking_homestay.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingHomestay $bookingHomestay)
    {
        // 1. Load relasi yang dibutuhkan agar data media (bukti bayar) muncul di view
        $bookingHomestay->load(['media', 'kamar.homestay']);

        // 2. Ambil semua kamar aktif (jika admin ingin mengganti kamar saat edit)
        $kamars = KamarHomestay::whereHas('homestay', function ($query) {
            $query->where('status', 'aktif');
        })->with('homestay')->get();

        // 3. Ambil daftar warga (sesuaikan nama variabel dengan view: $warga)
        $warga = Warga::orderBy('nama')->get(['warga_id', 'nama', 'no_ktp']);

        // 4. Return ke view dengan variabel yang sinkron
        return view('pages.booking_homestay.edit', [
            'booking' => $bookingHomestay, // Kita kirim sebagai $booking
            'kamars' => $kamars,
            'warga' => $warga
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = BookingHomestay::findOrFail($id);

        // 1. Validasi Data
        $request->validate([
            'kamar_id' => 'required',
            'warga_id' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'status' => 'required',
            'metode_bayar' => 'required',
            'filename.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2000'
        ]);

        // 2. Hitung Ulang Total Harga (jika tanggal berubah)
        $kamar = KamarHomestay::findOrFail($request->kamar_id);
        $checkin = \Carbon\Carbon::parse($request->checkin);
        $checkout = \Carbon\Carbon::parse($request->checkout);
        $days = $checkin->diffInDays($checkout);
        $total = ($days == 0 ? 1 : $days) * $kamar->harga;

        // 3. Update Data Utama
        $booking->update(array_merge($request->all(), [
            'total' => $total
        ]));

        // A. Logika HAPUS foto bukti pembayaran yang diceklis
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = \App\Models\Media::find($mediaId);
                if ($media) {
                    // Hapus file fisik dari folder public/images/pembayaran
                    $path = public_path('images/pembayaran/' . $media->file_name);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    // Hapus record di database
                    $media->delete();
                }
            }
        }

        // B. Logika TAMBAH foto bukti pembayaran baru
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('images/pembayaran'), $filename);

                \App\Models\Media::create([
                    'file_name' => $filename,
                    'ref_id' => $booking->booking_id, // Pastikan PK Anda booking_id
                    'ref_table' => 'booking_homestay',            // Sesuai konvensi kita sebelumnya
                ]);
            }
        }

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Data booking berhasil diperbarui!');
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