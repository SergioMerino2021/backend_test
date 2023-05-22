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
        Schema::create('portatiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producte_id');
            $table->integer('capacidad_bateria');
            $table->integer('amperaje_cargador');
            $table->timestamps();

            $table->foreign('producte_id')->references('id')->on('productes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portatiles');
    }
};
