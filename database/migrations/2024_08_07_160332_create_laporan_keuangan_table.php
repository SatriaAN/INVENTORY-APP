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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_beli');
            $table->string('satuan', 255);
            $table->string('nama_barang', 255);
            $table->integer('harga_satuan');
            $table->integer('harga_ongkir');
            $table->integer('kredit');
            $table->integer('debet');
            $table->integer('sisa_saldo');
            $table->integer('total_keseluruhan');
            $table->integer('total_bayar');
            $table->integer('total_diskon');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};