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
        Schema::create('progress_customs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_progress');
            $table->string('deskripsi_progress');
            $table->string('gambar_progress');
            $table->foreignId('custom_id')->constrained('transaksi_custom_designs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_customs');
    }
};
