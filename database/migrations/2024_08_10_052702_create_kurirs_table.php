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
    Schema::create('kurirs', function (Blueprint $table) {
        $table->id();
        $table->string('kurir_id')->unique();
        $table->string('nama');
        $table->string('alamat');
        $table->integer('umur');
        $table->string('gender');
        $table->foreignId('jenis_barang')->constrained('jenis_barangs');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurirs');
    }
};
