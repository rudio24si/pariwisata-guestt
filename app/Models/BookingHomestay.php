<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHomestay extends Model
{
    use HasFactory;

    protected $table = 'booking_homestay';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'kamar_id',
        'warga_id',
        'checkin',
        'checkout',
        'jumlah_malam',
        'total',
        'status',
        'metode_bayar',
        'catatan'
    ];

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'total' => 'decimal:2',
        'jumlah_malam' => 'integer'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    // Relasi ke kamar
    public function kamar()
    {
        return $this->belongsTo(KamarHomestay::class, 'kamar_id', 'kamar_id');
    }

    // Relasi ke warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke homestay melalui kamar
    public function homestay()
    {
        return $this->hasOneThrough(
            Homestay::class,
            KamarHomestay::class,
            'kamar_id', // Foreign key pada KamarHomestay
            'homestay_id', // Foreign key pada Homestay
            'kamar_id', // Local key pada BookingHomestay
            'homestay_id' // Local key pada KamarHomestay
        );
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => ['text' => 'Menunggu', 'class' => 'warning'],
            'confirmed' => ['text' => 'Dikonfirmasi', 'class' => 'info'],
            'checked_in' => ['text' => 'Check-in', 'class' => 'primary'],
            'checked_out' => ['text' => 'Check-out', 'class' => 'success'],
            'cancelled' => ['text' => 'Dibatalkan', 'class' => 'danger']
        ];

        return $labels[$this->status] ?? ['text' => $this->status, 'class' => 'secondary'];
    }

    // Accessor untuk metode bayar label
    public function getMetodeBayarLabelAttribute()
    {
        $labels = [
            'tunai' => 'Tunai',
            'transfer' => 'Transfer Bank',
            'qris' => 'QRIS',
            'kredit' => 'Kartu Kredit'
        ];

        return $labels[$this->metode_bayar] ?? $this->metode_bayar;
    }

    // Calculate jumlah malam
    public function calculateJumlahMalam()
    {
        $checkin = \Carbon\Carbon::parse($this->checkin);
        $checkout = \Carbon\Carbon::parse($this->checkout);
        return $checkout->diffInDays($checkin);
    }

    // Calculate total harga
    public function calculateTotal()
    {
        $jumlahMalam = $this->calculateJumlahMalam();
        $hargaKamar = $this->kamar ? $this->kamar->harga : 0;
        return $jumlahMalam * $hargaKamar;
    }

    public function media()
    {
        // ref_id adalah foreign key, id adalah owner key di DestinasiWisata
        return $this->hasMany(Media::class, 'ref_id', 'booking_id')
            ->where('ref_table', 'booking_homestay');
    }
}