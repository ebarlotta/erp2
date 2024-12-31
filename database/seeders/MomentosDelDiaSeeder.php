<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MomentosDelDiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('momentos_del_dias')->insert(['descripcion' => 'Desayuno']);
        DB::table('momentos_del_dias')->insert(['descripcion' => 'Almuerzo']);
        DB::table('momentos_del_dias')->insert(['descripcion' => 'Merienda']);
        DB::table('momentos_del_dias')->insert(['descripcion' => 'Cena']);
    }
}
