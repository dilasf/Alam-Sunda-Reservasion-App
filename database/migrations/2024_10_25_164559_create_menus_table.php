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
        Schema::create('menus', function (Blueprint $table) {
            $table->tinyInteger('idMenu')->primary();
            $table->string('nama',100);
            $table->tinyInteger('idDetailMenu')->unsigned()->foreignId('idDetailMenu')->constrained('detail_menus', 'idDetailMenu')->onDelete('cascade');
            $table->tinyInteger('idKategori')->unsigned()->foreignId('idKategori')->constrained('kategoris', 'idKategori')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
