<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('nama_menu');
            $table->string('kategori_menu');
            $table->integer('harga');
            $table->integer('stok_porsi')->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status_menu', ['Tersedia', 'Habis'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
