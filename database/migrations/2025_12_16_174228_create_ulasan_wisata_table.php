<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ulasan_wisata', function (Blueprint $table) {
            $table->id('ulasan_id');
            $table->unsignedBigInteger('destinasi_id');
            $table->unsignedBigInteger('warga_id');
            $table->integer('rating');
            $table->text('komentar');
            $table->timestamp('waktu');
            $table->foreign('destinasi_id')
                ->references('destinasi_id')
                ->on('destinasi_wisata')
                ->onDelete('cascade');
            $table->foreign('warga_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_wisata');
    }
};