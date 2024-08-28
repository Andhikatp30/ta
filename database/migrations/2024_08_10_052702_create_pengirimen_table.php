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
    Schema::create('pengirimens', function (Blueprint $table) {
        $table->id();
        $table->string('id_pengiriman')->unique();
        $table->foreignId('barang_id')->constrained('barangs');
        $table->foreignId('kurir_id')->constrained('kurirs');
        $table->string('status_pengiriman');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
