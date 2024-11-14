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
        Schema::create('menu_detail_menu', function (Blueprint $table) {
            $table->tinyInteger('idMenu')->unsigned();
            $table->tinyInteger('idDetailMenu')->unsigned();
            $table->foreign('idMenu')->references('idMenu')->on('menus')->onDelete('cascade');
            $table->foreign('idDetailMenu')->references('idDetailMenu')->on('detail_menus')->onDelete('cascade');
            $table->primary(['idMenu', 'idDetailMenu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_detail_menu');
    }
};
