<?php

namespace Database\Seeders\geri;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterfacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interfaces')->truncate();
        DB::table('interfaces')->insert(['Nombreinterface'=>'Empleados Temporales','TipoPersona_id'=>3]);
        DB::table('interfaces')->insert(['Nombreinterface'=>'Empleados Mensuales','TipoPersona_id'=>4]);
    }
}
