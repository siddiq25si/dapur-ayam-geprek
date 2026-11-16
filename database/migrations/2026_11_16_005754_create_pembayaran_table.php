<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_pesanan');
            $table->dateTime('tanggal_bayar');
            $table->integer('jumlah_bayar');
            $table->string('bukti_transfer');
            $table->enum('status_verifikasi', [
                'Menunggu Verifikasi',
                'Terverifikasi',
                'Ditolak'
            ])->default('Menunggu Verifikasi');
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
