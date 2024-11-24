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
        Schema::create('transaksi_custom_designs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_custom');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status_pembayaran', ['Dalam Transaksi', 'Belum Dibayar', 'Dibayar', 'Diterima', 'Selesai', 'Ditolak', 'Dibatalkan']);
            $table->string('nama_pemesan');
            $table->string('alamat_pemesan');
            $table->string('email_pemesan');
            $table->string('nomor_hp_pemesan');
            $table->string('catatan')->nullable();
            $table->integer('total_pesanan');
            $table->integer('total_harga')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('delivery', ['Diantar Ke Tempat Pemesan', 'Ambil Di Martaloka'])->nullable();
            $table->text('no_resi')->nullable();
            $table->string('kurir')->nullable();
            $table->string('tujuan_antar')->nullable();
            $table->dateTime('tanggal_ambil')->nullable();
            $table->string('keterangan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_custom_designs');
    }
};
