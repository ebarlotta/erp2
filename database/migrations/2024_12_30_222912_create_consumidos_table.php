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
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('elemento_id');
            $table->double('cantidad');
            $table->unsignedBigInteger('momento_del_dia_id');
            $table->unsignedBigInteger('dia_de_la_semana_id');
            $table->timestamps();

            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->foreign('momento_del_dia_id')->references('id')->on('momentos_del_dias');
            $table->foreign('dia_de_la_semana_id')->references('id')->on('dias_de_la_semanas');
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
