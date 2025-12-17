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

    public function ulasan()
    {
        return $this->hasMany(UlasanWisata::class, 'destinasi_id', 'destinasi_id');
    }

    public function media()
    {
        // ref_id adalah foreign key, id adalah owner key di DestinasiWisata
        return $this->hasMany(Media::class, 'ref_id', 'destinasi_id')
            ->where('ref_table', 'destinasi_wisata');
    }
}