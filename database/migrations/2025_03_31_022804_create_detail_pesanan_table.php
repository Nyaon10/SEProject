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
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->increments('ID_Detail_Pesanan');
            $table->string('ID_Pesanan');
            $table->foreign('ID_Pesanan')->references('ID_Pesanan')->on('pesanan')->onUpdate('cascade')->onDelete('restrict');
            $table->string('ID_Barang');
            $table->foreign('ID_Barang')->references('ID_Barang')->on('barang')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('Jumlah_Barang');
            $table->decimal('Harga_Satuan', 10, 2);
            $table->decimal('Subtotal', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
