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
        Schema::create('item_pesanans', function (Blueprint $table) {
            $table->id('idItemPesanan');
            $table->foreignId('idPesanan')->constrained('pesanans', 'idPesanan')->onDelete('cascade');
            $table->tinyInteger('idMenus')->unsigned();
            $table->foreign('idMenus')->references('idMenu')->on('menus')->onDelete('cascade');
            $table->smallInteger('jumlah');
            $table->decimal('harga', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pesanans');
    }
};
