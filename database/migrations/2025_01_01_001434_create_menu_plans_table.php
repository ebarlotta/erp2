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
        Schema::create('menu_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('plan_id');
            $table->integer('dia');
            $table->double('cantidad');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('plan_id')->references('id')->on('plan_alimentarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_plans');
    }
};
