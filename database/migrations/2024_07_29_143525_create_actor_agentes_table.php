<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_agentes', function (Blueprint $table) {
            $table->id();
            $table->date('fingreso');
            $table->date('fegreso')->nullable();
            $table->string('alias')->nullable();
            $table->double('peso_id');
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('actor_referente')->nullable();
            $table->unsignedBigInteger('cama_id');
            $table->unsignedBigInteger('datossociales_id')->nullable();  //hacer
            $table->unsignedBigInteger('datosmedicos_id')->nullable();   //hacer
            $table->unsignedBigInteger('motivos_egreso_id')->nullable();
            $table->unsignedBigInteger('grado_dependencia_id')->nullable();
            $table->unsignedBigInteger('historiadevida_id')->nullable(); //hacer
            // $table->unsignedBigInteger('informes_id')->nullable();       //hacer

            $table->timestamps();

            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('actor_referente')->references('id')->on('actors');
            $table->foreign('cama_id')->references('id')->on('camas')->default(0);
            $table->foreign('datossociales_id')->references('id')->on('datos_socials');
            $table->foreign('datosmedicos_id')->references('id')->on('datos_medicos');
            $table->foreign('motivos_egreso_id')->references('id')->on('motivos_egresos');
            $table->foreign('grado_dependencia_id')->references('id')->on('grado_dependencias');
            $table->foreign('historiadevida_id')->references('id')->on('historia_vidas');
            // $table->foreign('informes_id')->references('id')->on('informes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_agentes');
    }
}