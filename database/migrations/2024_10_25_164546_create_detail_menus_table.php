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
        Schema::create('detail_menus', function (Blueprint $table) {
            $table->tinyInteger('idDetailMenu')->unsigned()->primary()->autoIncrement();
            $table->string('nama',100);
            $table->text('deskripsi');
            $table->string('gambar');
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_menus');
    }
};
