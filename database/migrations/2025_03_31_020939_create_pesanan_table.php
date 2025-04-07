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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->string('ID_Pesanan')->primary();
            $table->string('ID_Pelanggan');
            $table->foreign('ID_Pelanggan')->references('ID_Pelanggan')->on('pelanggan')->onUpdate('cascade')->onDelete('restrict');
            $table->date('Tanggal_Pesanan');
            $table->text('Status_Pesanan');
            $table->decimal('Total_Harga', 10, 2);
            $table->string('Metode_Pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
