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
        Schema::create('elementos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->double('existencia')->default(0); 
            $table->double('precio_compra')->default(0); 
            $table->double('stock_minimo')->default(0); 
            $table->date('vencimiento');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('empresa_id'); 

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('unidad_id')->references('id')->on('unidads');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos');
    }
};
