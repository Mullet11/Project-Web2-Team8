<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('no_booking')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            
            // Info Peminjam
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi_fakultas');
            $table->string('whatsapp');
            
            // Rincian Kegiatan
            $table->enum('perihal', ['Perkuliahan', 'Kegiatan Kampus']);
            $table->string('dosen')->nullable();
            $table->string('matakuliah')->nullable();
            $table->string('nama_kegiatan')->nullable();
            
            // Waktu
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            
            // Status & Catatan
            $table->enum('status', ['menunggu', 'disetujui', 'dibatalkan', 'selesai'])->default('menunggu');
            $table->text('alasan_batal')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
