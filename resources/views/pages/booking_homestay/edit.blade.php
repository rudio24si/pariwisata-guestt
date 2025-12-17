@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Booking Kamar</h4>
                        </div>

                        <div class="card-body p-4">
                            <div class="room-info mb-4 p-3 bg-light rounded">
                                <h5 class="text-dark mb-2">{{ $booking->kamar->nama_kamar }}</h5>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-house-door me-2"></i>{{ $booking->kamar->homestay->nama }}
                                </p>
                                <p class="h5 text-success mb-0">
                                    Rp <span id="hargaPerMalam">{{ number_format($booking->kamar->harga) }}</span>
                                    <small class="text-muted">/malam</small>
                                </p>
                            </div>

                            <form action="{{ route('booking-homestay.update', $booking->booking_id) }}" method="POST" id="bookingForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <input type="hidden" name="kamar_id" value="{{ $booking->kamar_id }}">
                                <input type="hidden" name="total" id="totalHargaInput" value="{{ $booking->total }}">

                                <div class="mb-3">
                                    <label for="status" class="form-label fw-medium">Status Booking</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                        <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="warga_id" class="form-label fw-medium">Pilih Warga</label>
                                    <select name="warga_id" id="warga_id" class="form-select" required>
                                        @foreach($warga as $w)
                                            <option value="{{ $w->warga_id }}" {{ $booking->warga_id == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="checkin" class="form-label fw-medium">Check-in</label>
                                        <input type="date" name="checkin" id="checkin" class="form-control" 
                                               value="{{ $booking->checkin }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="checkout" class="form-label fw-medium">Check-out</label>
                                        <input type="date" name="checkout" id="checkout" class="form-control" 
                                               value="{{ $booking->checkout }}" required>
                                    </div>
                                </div>

                                <div class="price-summary mb-4 p-3 border rounded bg-white">
                                    <h6 class="fw-medium mb-3">Ringkasan Harga</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Harga per malam:</span>
                                        <span>Rp {{ number_format($booking->kamar->harga) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Jumlah malam:</span>
                                        <span><span id="jumlahMalam">0</span> malam</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="d-flex justify-content-between fw-bold fs-5 text-primary">
                                        <span>Total Harga:</span>
                                        <span>Rp <span id="totalHargaDisplay">{{ number_format($booking->total) }}</span></span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="metode_bayar" class="form-label fw-medium">Metode Pembayaran</label>
                                    <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                        @foreach(['transfer', 'qris', 'tunai', 'kredit'] as $method)
                                            <option value="{{ $method }}" {{ $booking->metode_bayar == $method ? 'selected' : '' }}>
                                                {{ ucfirst($method) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">Bukti Pembayaran Saat Ini</label>
                                    <div class="row mb-2">
                                        @forelse($booking->media as $m)
                                            <div class="col-4 position-relative">
                                                <img src="{{ asset('images/pembayaran/' . $m->file_name) }}" class="img-thumbnail w-100" style="height: 80px; object-fit: cover;">
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" name="delete_media[]" value="{{ $m->media_id }}" id="del{{ $m->media_id }}">
                                                    <label class="form-check-label small text-danger" for="del{{ $m->media_id }}">Hapus</label>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12"><small class="text-muted italic">Belum ada bukti pembayaran.</small></div>
                                        @endforelse
                                    </div>
                                    
                                    <label for="filename" class="form-label fw-medium mt-2">Tambah/Ganti Bukti</label>
                                    <input type="file" name="filename[]" id="filename" class="form-control" accept="image/*" multiple>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('booking-homestay.index') }}" class="btn btn-outline-secondary">
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hargaPerMalam = {{ $booking->kamar->harga }};
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');
            const jumlahMalamSpan = document.getElementById('jumlahMalam');
            const totalHargaDisplay = document.getElementById('totalHargaDisplay');
            const totalHargaInput = document.getElementById('totalHargaInput');

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function updatePrice() {
                if (checkinInput.value && checkoutInput.value) {
                    const start = new Date(checkinInput.value);
                    const end = new Date(checkoutInput.value);
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays > 0) {
                        const total = diffDays * hargaPerMalam;
                        jumlahMalamSpan.textContent = diffDays;
                        totalHargaDisplay.textContent = formatRupiah(total);
                        totalHargaInput.value = total;
                        return;
                    }
                }
                jumlahMalamSpan.textContent = '0';
            }

            checkinInput.addEventListener('change', updatePrice);
            checkoutInput.addEventListener('change', updatePrice);

            // Jalankan saat halaman pertama kali dimuat
            updatePrice();
        });
    </script>
@endsection