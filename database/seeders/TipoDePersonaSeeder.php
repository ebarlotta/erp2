<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipoDePersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('tipo_de_personas')->truncate();
        //DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Residente',]);
        //DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Referente',]);
        //DB::table('tipo_de_personas')->truncate();
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Agente',]); //1
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Referente',]); // 2
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Personal',]); // 3
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Proveedor',]); // 4
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Cliente',]); // 5
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Vendedor',]); // 6
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Empresa',]); // 7
    }
}
