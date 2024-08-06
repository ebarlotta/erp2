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
        Schema::create('elemento_productos', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');
            $table->string('barra');
            $table->string('qr');
            $table->string('descuento');
            $table->double('calificacion');
            $table->double('descuento_especial');
            $table->double('precio_venta');
            $table->string('lote')->nullable();
            $table->string('ruta');

            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('elemento_id');
            
            $table->timestamps();
            
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->foreign('estado_id')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento_productos');
    }
};
