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
        Schema::create('agenteinformes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agente_id');
            $table->unsignedBigInteger('informe_id');
            $table->integer('nroperiodo')->default(1);
            $table->string('anio');
            $table->unsignedBigInteger('profesional_id');
            $table->unsignedBigInteger('empresa_id');

            $table->timestamps();

            $table->foreign('agente_id')->references('id')->on('actors');
            $table->foreign('informe_id')->references('id')->on('informes');
            // $table->foreign('agente_id')->references('id')->on('actors_agentes');
            $table->foreign('profesional_id')->references('id')->on('actors');
            // $table->foreign('profesional_id')->references('id')->on('actor_personals');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenteinformes');
    }
};
