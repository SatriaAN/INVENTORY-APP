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
        Schema::create('katalog_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 100);
            $table->integer('harga_beli');
            $table->integer('harga_satuan');
            $table->integer('harga_jual');
            $table->integer('stok_awal');
            $table->integer('stok_masuk'); // Field untuk stok_masuk
            $table->integer('terjual'); // Field untuk terjual
            $table->integer('stok_akhir');
            $table->integer('kas_masuk');
            $table->integer('profit');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog_barang');
    }
};