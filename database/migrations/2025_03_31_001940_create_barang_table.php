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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('ID_Barang')->primary();
            $table->string('Nama_Barang');
            $table->text('Deskripsi_Barang');
            $table->json('Gambar_Barang');
            $table->unsignedInteger('ID_Kategori');
            $table->foreign('ID_Kategori')->references('ID_Kategori')->on('kategori')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('Jumlah_Barang');
            $table->decimal('Harga_Barang', 10, 2);
            $table->date('Tanggal_Stok_Barang');
            $table->text('Keterangan')->nullable();
            $table->string('Status_Barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
