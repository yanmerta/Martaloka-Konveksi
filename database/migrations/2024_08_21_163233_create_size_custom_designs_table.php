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
        Schema::create('size_custom_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_custom_design_id')->constrained('transaksi_custom_designs')->onDelete('cascade');
            $table->integer('co_s')->nullable();
            $table->integer('co_m')->nullable();
            $table->integer('co_l')->nullable();
            $table->integer('co_xl')->nullable();
            $table->integer('co_xxl')->nullable();
            $table->integer('co_l1')->nullable();
            $table->integer('co_l2')->nullable();
            $table->integer('co_l3')->nullable();
            $table->integer('co_l4')->nullable();
            $table->integer('ce_s')->nullable();
            $table->integer('ce_m')->nullable();
            $table->integer('ce_l')->nullable();
            $table->integer('ce_xl')->nullable();
            $table->integer('ce_xxl')->nullable();
            $table->integer('ce_l1')->nullable();
            $table->integer('ce_l2')->nullable();
            $table->integer('ce_l3')->nullable();
            $table->integer('ce_l4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_custom_designs');
    }
};
