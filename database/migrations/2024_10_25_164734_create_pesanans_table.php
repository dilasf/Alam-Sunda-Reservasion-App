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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('idPesanan');
            $table->foreignId('idUser')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('idItemPesanan')->constrained('item_pesanans', 'idItemPesanan')->onDelete('cascade');
            $table->foreignId('idPengiriman')->nullable()->constrained('pengirimans', 'idPengiriman')->onDelete('set null');
            $table->dateTime('tanggalPesanan');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan']);
            $table->decimal('jumlahTotal', 10, 2);
            $table->enum('tipePesanan', ['takeaway', 'delivery'])->default('takeaway');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
