<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);                    // Nama paket trip
            $table->string('lokasi', 100);                  // Lokasi destinasi
            $table->text('deskripsi');                      // Deskripsi trip
            $table->integer('harga');                       // Harga per orang
            $table->string('gambar')->nullable();           // Foto trip (nullable)
            $table->integer('durasi');                      // Durasi dalam hari
            $table->json('fasilitas')->nullable();          // Fasilitas (array JSON)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();                           // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
