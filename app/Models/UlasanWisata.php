<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UlasanWisata extends Model
{
    use HasFactory;

    protected $table = 'ulasan_wisata';
    protected $primaryKey = 'ulasan_id';

    // Laravel secara default mencari 'created_at'. 
    // Jika kamu menggunakan kolom 'waktu', kita matikan timestamps atau sesuaikan.
    public $timestamps = false;

    protected $fillable = [
        'destinasi_id',
        'warga_id',
        'rating',
        'komentar',
        'waktu'
    ];

    // Relasi ke Destinasi
    public function destinasi()
    {
        return $this->belongsTo(DestinasiWisata::class, 'destinasi_id');
    }

    // Relasi ke User/Warga
    public function user()
    {
        return $this->belongsTo(User::class, 'warga_id');
    }
}