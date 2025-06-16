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
        Schema::create('consumidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('elemento_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->double('cantidad');
            $table->unsignedBigInteger('momento_del_dia_id');
            $table->integer('dia_de_la_semana');
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('consumido')->default(0);
            $table->boolean('cerrado')->default(0);
            $table->timestamps();

            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('momento_del_dia_id')->references('id')->on('momentos_del_dias');
            // $table->foreign('dia_de_la_semana_id')->references('id')->on('dias_de_la_semanas');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumidos');
    }
};
