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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('ID_Pembayaran')->primary();
            $table->string('ID_Pesanan');
            $table->foreign('ID_Pesanan')->references('ID_Pesanan')->on('pesanan')->onUpdate('cascade')->onDelete('restrict');
            $table->date('Tanggal_Pembayaran');
            $table->decimal('Jumlah_Bayaran_Terima', 10, 2);
            $table->decimal('Total_Tagihan', 10, 2);
            $table->string('Status_Pembayaran');
            $table->string('Metode_Pembayaran');
            $table->json('Bukti_Pembayaran');
            $table->string('Tipe_Transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
