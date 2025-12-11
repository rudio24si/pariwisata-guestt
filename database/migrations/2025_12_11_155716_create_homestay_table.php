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
        Schema::create('homestay', function (Blueprint $table) {
            $table->id('homestay_id');
            $table->foreignId('pemilik_warga_id')->nullable()->constrained('warga', 'warga_id')->onDelete('set null');
            $table->string('nama', 200);
            $table->text('alamat');
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->json('fasilitas_json')->nullable();
            $table->decimal('harga_per_malam', 10, 2)->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestay');
    }
};