<?php

namespace Database\Seeders;

use App\Models\Modulo;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos=Modulo::all();
        // dd($modulos);
        $a=[];
        foreach($modulos as $modulo) {
            DB::table('permissions')->insert(['name'=>strtolower($modulo->name) . '.Agregar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->name) . '.Eliminar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->name) . '.Modificar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->name) . '.Ver','guard_name'=>'web']);
        }
    }
}
