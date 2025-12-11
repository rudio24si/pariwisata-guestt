<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('destinasi_wisata', function (Blueprint $table) {
            $table->id('destinasi_id');
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->text('alamat');
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->decimal('tiket', 10, 2)->default(0); // DECIMAL(10,2)
            $table->string('kontak', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi_wisata');
    }
};