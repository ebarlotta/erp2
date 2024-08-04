<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('direccion');
            // $table->bigInteger('cuit');
            $table->string('cuit');
            $table->bigInteger('ib');
            $table->string('imagen')->nullable();
            $table->integer('establecimiento')->default(0);
            $table->bigInteger('telefono');
            $table->string('actividad');
            $table->string('actividad1');
            $table->integer('menu')->default('2');
            $table->string('email')->nullable();
            $table->boolean('habilitada')->default(true);
            $table->string('nombretitular')->nullable();
            $table->bigInteger('dnititular')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
