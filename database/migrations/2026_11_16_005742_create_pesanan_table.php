<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->dateTime('tanggal_pesan');
            $table->dateTime('tanggal_pengantaran');
            $table->text('alamat_pengantaran');
            $table->integer('total_harga');
            $table->enum('status_pesanan', [
                'Menunggu Konfirmasi',
                'Sedang Dimasak',
                'Dalam Pengiriman',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu Konfirmasi');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
