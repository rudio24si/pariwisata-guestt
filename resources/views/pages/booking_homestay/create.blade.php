@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center vh-100">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Booking Kamar</h4>
                        </div>

                        <div class="card-body p-4">
                            <!-- Room Information -->
                            <div class="room-info mb-4 p-3 bg-light rounded">
                                <h5 class="text-dark mb-2">{{ $kamar->nama_kamar }}</h5>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-house-door me-2"></i>{{ $kamar->homestay->nama }}
                                </p>
                                <p class="h5 text-success mb-0">
                                    Rp <span id="hargaPerMalam">{{ number_format($kamar->harga) }}</span>
                                    <small class="text-muted">/malam</small>
                                </p>
                            </div>

                            <!-- Booking Form -->
                            <form action="{{ route('booking-homestay.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="kamar_id" value="{{ $kamar->kamar_id }}">
                                <input type="hidden" name="total_harga" id="totalHargaInput" value="">

                                <!-- Warga Selection -->
                                <div class="mb-3">
                                    <label for="warga_id" class="form-label fw-medium">Pilih Warga</label>
                                    <select name="warga_id" id="warga_id" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Warga --</option>
                                        @foreach($warga as $w)
                                            <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Date Selection -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="checkin" class="form-label fw-medium">Check-in</label>
                                        <input type="date" name="checkin" id="checkin" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="checkout" class="form-label fw-medium">Check-out</label>
                                        <input type="date" name="checkout" id="checkout" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Price Summary -->
                                <div class="price-summary mb-4 p-3 border rounded bg-white">
                                    <h6 class="fw-medium mb-3">Ringkasan Harga</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Harga per malam:</span>
                                        <span>Rp <span
                                                id="displayHargaPerMalam">{{ number_format($kamar->harga) }}</span></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Jumlah malam:</span>
                                        <span><span id="jumlahMalam">0</span> malam</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="d-flex justify-content-between fw-bold fs-5 text-primary">
                                        <span>Total Harga:</span>
                                        <span>Rp <span id="totalHargaDisplay">0</span></span>
                                    </div>
                                    <small class="text-muted d-block mt-2" id="dateRangeInfo">Pilih tanggal check-in dan
                                        check-out</small>
                                </div>

                                <!-- Payment Method -->
                                <div class="mb-4">
                                    <label for="metode_bayar" class="form-label fw-medium">Metode Pembayaran</label>
                                    <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>

                                        <option value="transfer">
                                            Transfer Bank
                                        </option>
                                        <option value="qris">
                                            QRIS
                                        </option>
                                        <option value="tunai"> Tunai (Cash)
                                        </option>
                                        <option value="kredit"> Kredit
                                        </option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                        <i class="bi bi-calendar-check me-2"></i> Konfirmasi Booking
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i> Kembali
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
            const hargaPerMalam = {{ $kamar->harga }};
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');
            const jumlahMalamSpan = document.getElementById('jumlahMalam');
            const totalHargaDisplay = document.getElementById('totalHargaDisplay');
            const totalHargaInput = document.getElementById('totalHargaInput');
            const dateRangeInfo = document.getElementById('dateRangeInfo');
            const submitBtn = document.getElementById('submitBtn');
            const bookingForm = document.getElementById('bookingForm');

            // Format number to Indonesian currency
            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Calculate days between two dates
            function calculateDays(checkin, checkout) {
                const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
                const firstDate = new Date(checkin);
                const secondDate = new Date(checkout);

                const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
                return diffDays;
            }

            // Update price calculation
            function updatePrice() {
                const checkin = checkinInput.value;
                const checkout = checkoutInput.value;

                if (checkin && checkout) {
                    const jumlahMalam = calculateDays(checkin, checkout);

                    if (jumlahMalam > 0) {
                        const totalHarga = hargaPerMalam * jumlahMalam;

                        jumlahMalamSpan.textContent = jumlahMalam;
                        totalHargaDisplay.textContent = formatRupiah(totalHarga);
                        totalHargaInput.value = totalHarga;

                        // Format dates for display
                        const options = { day: 'numeric', month: 'long', year: 'numeric' };
                        const checkinDate = new Date(checkin).toLocaleDateString('id-ID', options);
                        const checkoutDate = new Date(checkout).toLocaleDateString('id-ID', options);

                        dateRangeInfo.textContent = `${checkinDate} - ${checkoutDate}`;
                        dateRangeInfo.className = 'text-success d-block mt-2';

                        // Enable submit button
                        submitBtn.disabled = false;
                        return;
                    }
                }

                // Reset if invalid
                jumlahMalamSpan.textContent = '0';
                totalHargaDisplay.textContent = '0';
                totalHargaInput.value = '';
                dateRangeInfo.textContent = 'Pilih tanggal check-in dan check-out';
                dateRangeInfo.className = 'text-muted d-block mt-2';
                submitBtn.disabled = true;
            }

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            checkinInput.min = today;
            checkoutInput.min = today;

            // Update checkout min date when checkin changes
            checkinInput.addEventListener('change', function () {
                checkoutInput.min = this.value;
                if (checkoutInput.value && checkoutInput.value < this.value) {
                    checkoutInput.value = this.value;
                }
                updatePrice();
            });

            // Update price when checkout changes
            checkoutInput.addEventListener('change', function () {
                if (checkinInput.value && this.value <= checkinInput.value) {
                    alert('Tanggal check-out harus setelah tanggal check-in');
                    this.value = '';
                    updatePrice();
                    return;
                }
                updatePrice();
            });

            // Validate form before submit
            bookingForm.addEventListener('submit', function (e) {
                if (!totalHargaInput.value || totalHargaInput.value <= 0) {
                    e.preventDefault();
                    alert('Mohon pilih tanggal yang valid');
                    return false;
                }

                // Optional: Show confirmation with price
                const confirmed = confirm(`Konfirmasi booking dengan total harga Rp ${formatRupiah(totalHargaInput.value)}?`);
                if (!confirmed) {
                    e.preventDefault();
                }
            });

            // Initial state
            updatePrice();
        });
    </script>
@endsection