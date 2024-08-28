<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('id_barang')->unique();
        $table->string('nama_barang');
        $table->string('nama_instansi');
        $table->date('tanggal_kirim');
        $table->string('foto_barang')->nullable();
        $table->string('alamat_instansi');
        $table->foreignId('jenis_barang')->constrained('jenis_barangs');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
