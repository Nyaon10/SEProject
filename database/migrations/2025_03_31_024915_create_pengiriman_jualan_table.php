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
        Schema::create('pengiriman_jualan', function (Blueprint $table) {
            $table->string('ID_Pengiriman')->primary();
            $table->string('ID_Pesanan');
            $table->foreign('ID_Pesanan')->references('ID_Pesanan')->on('pesanan')->onUpdate('cascade')->onDelete('restrict');
            $table->string('Nama_Penerima');
            $table->string('No_Hp_Penerima');
            $table->text('Alamat_Pengiriman');
            $table->string('Kurir');
            $table->string('Tipe_Kurir');
            $table->string('Resi');
            $table->string('Status_Pengiriman')->default('Pending');
            $table->date('Tanggal_Kirim');
            $table->date('Tanggal_Terima');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_jualan');
    }
};
