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
        Schema::table('tb_library_transactions', function(Blueprint $table){
            $table->date('tanggal_kembali')->nullable()->change();
            $table->bigInteger('harga')->nullable()->change();
            $table->string('status')->default('Dalam peminjaman/belum kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
