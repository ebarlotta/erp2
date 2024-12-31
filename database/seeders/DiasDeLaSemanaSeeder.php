<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DiasDeLaSemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Lunes']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Martes']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Miércoles']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Jueves']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Viernes']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Sábado']);
        DB::table('dias_de_la_semanas')->insert(['nombre' => 'Domingo']);
    }
}
