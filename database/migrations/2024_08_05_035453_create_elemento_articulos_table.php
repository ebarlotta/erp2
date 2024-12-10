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
        Schema::create('elemento_articulos', function (Blueprint $table) {
            $table->id();
            $table->double('precio_venta');
            $table->string('marca')->nullable();
            $table->unsignedBigInteger('lista_id');
            $table->unsignedBigInteger('elemento_id');

            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->foreign('lista_id')->references('id')->on('listas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento_articulos');
    }
};
