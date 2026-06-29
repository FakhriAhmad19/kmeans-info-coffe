<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_segmentasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            $table->integer('cluster');
            $table->string('keterangan', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_segmentasis');
    }
};
