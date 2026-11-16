<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_web', function (Blueprint $table) {
            $table->id('id_pengaturan');
            $table->string('jam_buka');
            $table->string('no_whatsapp', 20);
            $table->string('status_halal')->default('Tersertifikasi Halal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_web');
    }
};
