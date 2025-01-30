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
        Schema::create('pesanan_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pesanan');
            $table->string('nama_produk');
            $table->date('tanggal_pesanan');
            $table->string('status_pesanan');
            $table->double('total_tagihan');
            $table->integer('jumlah_pesanan');
            $table->integer('id_bunga_keluar');
            $table->integer('id_barang_keluar');
            $table->double('biaya_jasa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_masuks');
    }
};
