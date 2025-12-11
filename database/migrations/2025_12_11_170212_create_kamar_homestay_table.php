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
        Schema::create('kamar_homestay', function (Blueprint $table) {
            $table->id('kamar_id');
            $table->foreignId('homestay_id')->constrained('homestay', 'homestay_id')->onDelete('cascade');
            $table->string('nama_kamar', 100);
            $table->integer('kapasitas')->default(1);
            $table->json('fasilitas_json')->nullable();
            $table->decimal('harga', 10, 2)->default(0);
            $table->timestamps();

            // Index untuk pencarian
            $table->index('homestay_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_homestay');
    }
};