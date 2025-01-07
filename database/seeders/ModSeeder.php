<?php

namespace Database\Seeders;

use App\Models\Modulo;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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
            DB::table('permissions')->insert(['name'=>strtolower($modulo->pagina) . '.Agregar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->pagina) . '.Eliminar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->pagina) . '.Modificar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo->pagina) . '.Ver','guard_name'=>'web']);
        }

        $modulos = array('Diseñar', 'PersonActivo', 'Informe', 'Persona', 'Carts');
        // $modulos = array('EmpresaUsuarios', 'ModuloUsuarios', 'Modulo', 'GestionModulo', 'Roles', 'Localidades', 'Nacionalidad', 'Elementos', 'Certificado', 'Tablas', 'Categoriaprofesional', 'Disenar', 'CompraSimple', 'Actor', 'Beneficios', 'EstadosCiviles', 'TiposDePersonas', 'TiposDeDocumentos', 'PersonActivo', 'Escolaridades', 'Informe', 'Medicamentos', 'Persona', 'Carts');


        foreach($modulos as $modulo) {
            DB::table('permissions')->insert(['name'=>strtolower($modulo) . '.Agregar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo) . '.Eliminar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo) . '.Modificar','guard_name'=>'web']);
            DB::table('permissions')->insert(['name'=>strtolower($modulo) . '.Ver','guard_name'=>'web']);
        }

        // acá van todos los sistemas o subsistemas para que puedan ser visibles
        DB::table('permissions')->insert(['name'=>strtolower('Administracion') . '.Ver','guard_name'=>'web']);
        DB::table('permissions')->insert(['name'=>strtolower('ERP') . '.Ver','guard_name'=>'web']);
        DB::table('permissions')->insert(['name'=>strtolower('Geri') . '.Ver','guard_name'=>'web']);
        DB::table('permissions')->insert(['name'=>strtolower('Localizacion') . '.Ver','guard_name'=>'web']);
        DB::table('permissions')->insert(['name'=>strtolower('Generales') . '.Ver','guard_name'=>'web']);
        DB::table('permissions')->insert(['name'=>strtolower('Informe') . '.Ver','guard_name'=>'web']);

        //Asigna al Usuario Administrador todos los permisos
        $permisos = Permission::all();
        $user = User::find(1);   // Busca a cada usuario y
        foreach($permisos as $permiso) {
            $user->givePermissionTo($permiso->name); // Agrega en model_has_permissions
            $aux = 'INSERT INTO role_has_permissions (permission_id, role_id) VALUES ('.$permiso->id.', 1)';
            db::select($aux);  // Agrega en role_has_permissions
        }



    }
}
       