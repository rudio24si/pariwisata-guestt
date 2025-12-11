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
        Schema::create('booking_homestay', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('kamar_id')->constrained('kamar_homestay', 'kamar_id')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('jumlah_malam')->default(1);
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->enum('metode_bayar', ['tunai', 'transfer', 'qris', 'kredit'])->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Indexes untuk pencarian
            $table->index(['kamar_id', 'warga_id']);
            $table->index('status');
            $table->index('checkin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_homestay');
    }
};