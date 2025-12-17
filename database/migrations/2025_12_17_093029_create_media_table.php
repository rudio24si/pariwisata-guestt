<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id'); // Primary Key sesuai gambar
            $table->string('ref_table'); // Nama tabel referensi (misal: homestays)
            $table->unsignedBigInteger('ref_id'); // ID dari tabel referensi tersebut
            $table->string('file_name'); // Perubahan dari file_url menjadi file_name sesuai instruksi
            $table->text('caption')->nullable(); // Keterangan foto
            $table->string('mime_type')->nullable(); // Tipe file (misal: image/jpeg)
            $table->integer('sort_order')->default(0); // Untuk mengurutkan tampilan foto
            $table->timestamps(); // (Opsional) created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};