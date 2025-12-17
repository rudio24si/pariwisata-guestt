<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarHomestay extends Model
{
    use HasFactory;

    protected $table = 'kamar_homestay';
    protected $primaryKey = 'kamar_id';

    protected $fillable = [
        'homestay_id',
        'nama_kamar',
        'kapasitas',
        'fasilitas_json',
        'harga'
    ];

    protected $casts = [
        'fasilitas_json' => 'array',
        'harga' => 'decimal:2',
        'kapasitas' => 'integer'
    ];

    // Relasi ke homestay
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    // Accessor untuk fasilitas formatted
    public function getFasilitasArrayAttribute()
    {
        return json_decode($this->fasilitas_json, true) ?? [];
    }

    public function getFasilitasFormattedAttribute()
    {
        return implode(', ', $this->fasilitas_array);
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'kamar_id')
            ->where('ref_table', 'kamar_homestay');
    }
}
