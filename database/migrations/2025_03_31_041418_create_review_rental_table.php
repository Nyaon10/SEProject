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
        Schema::create('review_rental', function (Blueprint $table) {
            $table->string('ID_Review')->primary();
            $table->string('ID_Pelanggan');
            $table->foreign('ID_Pelanggan')->references('ID_Pelanggan')->on('pelanggan')->onUpdate('cascade')->onDelete('restrict');
            $table->string('ID_Pesanan');
            $table->foreign('ID_Pesanan')->references('ID_Pesanan')->on('pesanan')->onUpdate('cascade')->onDelete('restrict');
            $table->string('ID_Barang');
            $table->foreign('ID_Barang')->references('ID_Barang')->on('barang')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('Rating');
            $table->text('Review')->nullable();
            $table->string('Kondisi_Pengembalian')->default('Baik');
            $table->date('Tanggal_Review')->default(DB::raw('CURRENT_DATE'));

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_rental');
    }
};
