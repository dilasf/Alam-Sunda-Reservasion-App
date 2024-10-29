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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('idReservasi');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('email');
            $table->string('no_telepon');
            $table->foreignId('idUsers')->constrained('users', 'id')->onDelete('cascade');
            $table->tinyInteger('idMeja')->unsigned()->foreignId('idMeja')->constrained('mejas', 'idMeja')->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->smallInteger('jumlahPengunjung');
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
