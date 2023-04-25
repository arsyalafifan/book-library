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
        Schema::create('tb_library_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_peminjaman')->unique();
            $table->string('nama_buku');
            $table->string('nama_anggota');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->bigInteger('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_library_transactions');
    }
};
