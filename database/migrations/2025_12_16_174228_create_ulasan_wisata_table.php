<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ulasan_wisata', function (Blueprint $table) {
            // Primary Key menggunakan ulasan_id sesuai gambar kamu
            $table->id('ulasan_id');

            // Foreign Key ke tabel destinasi_wisata
            // Pastikan kolom destinasi_id di tabel induk bertipe bigIncrements/id
            $table->unsignedBigInteger('destinasi_id');

            // Foreign Key ke tabel users (warga_id)
            $table->unsignedBigInteger('warga_id');

            $table->integer('rating');
            $table->text('komentar');
            $table->timestamp('waktu'); // Kolom waktu sesuai permintaan

            // Definisi Relasi (Foreign Key Constraints)
            $table->foreign('destinasi_id')
                ->references('destinasi_id') // Nama PK di tabel destinasi
                ->on('destinasi_wisata')     // Nama tabel destinasi kamu
                ->onDelete('cascade');

            $table->foreign('warga_id')
                ->references('id')           // Biasanya PK di tabel users adalah 'id'
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_wisata');
    }
};