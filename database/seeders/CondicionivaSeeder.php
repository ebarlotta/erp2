<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionivaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('condicionivas')->insert(['descripcion'=>'Consumidor Final','activo'=>true]);
        DB::table('condicionivas')->insert(['descripcion'=>'Responsable Excento','activo'=>true]);
        DB::table('condicionivas')->insert(['descripcion'=>'Responsable Inscripto','activo'=>true]);
        DB::table('condicionivas')->insert(['descripcion'=>'Monotributista','activo'=>true]);
    }
}
