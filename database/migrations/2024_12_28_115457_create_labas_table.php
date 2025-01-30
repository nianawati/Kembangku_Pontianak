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
        Schema::create('labas', function (Blueprint $table) {
            $table->id();
            $table->double('total_pendapatan');
            $table->double('total_beli');
            $table->double('total_kerugian');
            $table->double('total_labaBersih');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labas');
    }
};
