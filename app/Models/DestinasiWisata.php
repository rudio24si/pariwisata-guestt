<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    use HasFactory;

    protected $primaryKey = 'destinasi_id';
    protected $table = 'destinasi_wisata';

    protected $fillable = [
        'nama',
        'deskripsi',
        'alamat',
        'rt',
        'rw',
        'jam_buka',
        'jam_tutup',
        'tiket',
        'kontak'
    ];

    protected $casts = [
        'tiket' => 'decimal:2',
        'jam_buka' => 'datetime:H:i',
        'jam_tutup' => 'datetime:H:i',
    ];
}