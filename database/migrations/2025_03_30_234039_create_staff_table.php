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
        Schema::create('staff', function (Blueprint $table) {
            $table->string('ID_Staff')->primary();
            $table->integer('NIK_Staff')->unique();
            $table->string('Nama_Staff');
            $table->text('Alamat_Staff');
            $table->string('Email_Staff')->unique();
            $table->string('Password_Staff');
            $table->string('No_Hp_Staff');
            $table->string('Status_Staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
