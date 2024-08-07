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
        Schema::create('barang_terjual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('katalog_barang_id'); // Foreign key
            $table->integer('jumlah_terjual');
            $table->string('keterangan', 100);
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('katalog_barang_id')->references('id')->on('katalog_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_terjual');
    }
};