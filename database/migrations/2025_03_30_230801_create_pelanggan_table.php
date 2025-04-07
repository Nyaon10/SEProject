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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->string('ID_Pelanggan')->primary();
            $table->integer('NIK_Pelanggan')->index();
            $table->string('Nama_Pelanggan');
            $table->text('Alamat_Pelanggan');
            $table->string('Email_Pelanggan');
            $table->string('Password_Pelanggan');
            $table->string('No_Hp_Pelanggan');
            $table->string('Akun_Instagram');
            $table->boolean('Blacklist_Status')->default(false);
            $table->string('Status_Pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
