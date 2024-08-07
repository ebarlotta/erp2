<?php

namespace Database\Seeders\geri;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('localidades')->truncate();
        DB::table('localidades')->insert(['localidad_descripcion'=>'Ciudad','localidad_cp'=>5500,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'San Martín','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Palmira','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Rivadavia','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Junín','localidad_cp'=>5570,'provincia_id'=>1]);
    }
}
