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
        Schema::create('bunga_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bunga');
            $table->integer('jumlah_bunga');
            $table->date('tanggal_keluar');
            $table->integer('id_bunga');
            $table->integer('id_bunga_keluar');
            $table->double('total_harga');
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bunga_keluars');
    }
};
