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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('idTransaksi');
            $table->string('fotoBukti')->nullable();
            $table->date('tanggal');
            $table->decimal('totalPembayaran', 10, 2);
            $table->decimal('totalDibayar', 10, 2);
            $table->enum('status', ['pending', 'dibayar', 'diverifikasi', 'ditolak']);
            $table->foreignId('idReservasi')->nullable()->constrained('reservasis', 'idReservasi')->onDelete('set null');
            $table->foreignId('idPesanan')->nullable()->constrained('pesanans', 'idPesanan')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
