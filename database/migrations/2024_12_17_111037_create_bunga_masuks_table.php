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
        Schema::create('bunga_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bunga');
            $table->integer('jumlah_bunga');
            $table->double('harga_bunga');
            $table->double('harga_beli');
            $table->string('kategori');
            $table->string('foto');
            $table->date('tanggal_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bunga_masuks');
    }
};
