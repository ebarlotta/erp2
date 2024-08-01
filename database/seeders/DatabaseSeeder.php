<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Schema;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        $this->call(IvaSeeder::class);
        
        DB::table('empresas')->insert(['name' => 'Empresa de Pruebas','direccion' => 'Dirección','cuit' => '20123456789','ib' => '012345678','imagen' => 'BarBer.png','establecimiento' => '0','telefono' => '12345678','actividad' => 'Desarrollo','actividad1' => 'Software','menu' => '2','email'=>'enzo@gmail.com','habilitada'=>true,'nombretitular'=>'Enzo','dnititular'=>'1234',]);
        
        // \App\Models\Empresa::factory(4)->create();   //Crea una empresa de prueba para relacionar con los usuarios que se dan de alta

        // $this->call(TablaSeeder::class);

        \App\Models\Area::factory(30)->create();
        \App\Models\Cuenta::factory(30)->create();

        \App\Models\erp\Cliente::factory(10)->create();
        \App\Models\erp\Proveedor::factory(100)->create();
        \App\Models\erp\Categoriaprofesional::factory(10)->create();
        \App\Models\erp\Concepto::factory(10)->create();

        // Schema::dropIfExists('roles');
        // DB::raw('DELETE * FROM roles');
        // DB::table('roles')->insert(['name' => 'Administrador','guard_name' => 'web',]);
        // DB::table('roles')->insert(['name' => 'Usuario','guard_name' => 'web',]);

        // Schema::dropIfExists('empresa_usuarios');        
        // \App\Models\EmpresaUsuario::factory(10)->create();
        // \App\Models\Modulo::factory(10)->create();
        // DB::table('modulos')->insert(['name' => 'Areas','pagina' => 'areas','imagen' => 'areas.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Clientes','pagina' => 'clientes','imagen' => 'clientes.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Compras','pagina' => 'compras','imagen' => 'compras.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Cuentas','pagina' => 'cuentas','imagen' => 'cuentas.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Empleados','pagina' => 'empleados','imagen' => 'empleados.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Proveedores','pagina' => 'proveedores','imagen' => 'proveedores.jpg','leyenda' => '',]);
        // DB::table('modulos')->insert(['name' => 'Ventas','pagina' => 'ventas','imagen' => 'ventas.jpg','leyenda' => '',]);
        
        //Ralaciona los módulos de la empresa de prueba 
        $this->call(ModuloSeeder::class);

        
        $this->call(EmpresaModuloSeeder::class);
        \App\Models\erp\Empleado::factory(10)->create();
        \App\Models\EmpresaModulo::factory(10)->create();
        \App\Models\ModuloUsuario::factory(10)->create();
        \App\Models\erp\Tag::factory(10)->create();
        \App\Models\Unidad::factory(10)->create();
        \App\Models\erp\Categoriaproducto::factory(10)->create();
        \App\Models\erp\Estado::factory(50)->create();

        \App\Models\erp\Producto::factory(50)->create();



        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ======================================
        // Geri
        // ======================================

        // $this->call(EscolaridadesSeeder::class);
        DB::table('escolaridades')->insert(['escolaridadDescripcion'=>'Primaria Incompleta',]);
        DB::table('escolaridades')->insert(['escolaridadDescripcion'=>'Primaria Completa',]);
        DB::table('escolaridades')->insert(['escolaridadDescripcion'=>'Secundaria Incompleta',]);
        DB::table('escolaridades')->insert(['escolaridadDescripcion'=>'Secundaria Completa',]);
        // $this->call(TipoDePersonaSeeder::class);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Agente',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Referente',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Personal',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Proveedor',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Cliente',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Vendedor',]);
        DB::table('tipo_de_personas')->insert(['tipodepersona'=>'Empresa',]);
        // $this->call(EstadosCivilesSeeder::class);
        DB::table('estados_civiles')->insert(['estadocivil'=>'Casado/a',]);
        DB::table('estados_civiles')->insert(['estadocivil'=>'Viudo/a',]);
        DB::table('estados_civiles')->insert(['estadocivil'=>'Separado/a',]);
        // $this->call(TiposDocumentosSeeder::class);
        DB::table('tipos_documentos')->insert(['tipodocumento'=>'DNI',]);
        DB::table('tipos_documentos')->insert(['tipodocumento'=>'LC',]);
        // $this->call(BeneficiosSeeder::class);
        DB::table('beneficios')->insert(['descripcionbeneficio'=>'PARTICULAR',]);
        DB::table('beneficios')->insert(['descripcionbeneficio'=>'PAMI',]);
        // $this->call(PersonActivoSeeder::class);
        DB::table('person_activos')->insert(['estado'=>'Alta',]);
        DB::table('person_activos')->insert(['estado'=>'Baja',]);
        DB::table('person_activos')->insert(['estado'=>'En proceso de Baja',]);
        // $this->call(NacionalidadSeeder::class);
        DB::table('nacionalidads')->insert(['nacionalidad_descripcion'=>'Argentina',]);
        DB::table('nacionalidads')->insert(['nacionalidad_descripcion'=>'Española',]);
        DB::table('nacionalidads')->insert(['nacionalidad_descripcion'=>'Italiana',]);
        DB::table('nacionalidads')->insert(['nacionalidad_descripcion'=>'Otra',]);
        // $this->call(ProvinciasSeeder::class);
        DB::table('provincias')->insert(['provincia_descripcion'=>'Mendoza','nacionalidads_id'=>1]);
        DB::table('provincias')->insert(['provincia_descripcion'=>'San Juan','nacionalidads_id'=>1]);
        DB::table('provincias')->insert(['provincia_descripcion'=>'San Luis','nacionalidads_id'=>1]);
        // $this->call(LocalidadesSeeder::class);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Ciudad','localidad_cp'=>5500,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'San Martín','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Palmira','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Rivadavia','localidad_cp'=>5570,'provincia_id'=>1]);
        DB::table('localidades')->insert(['localidad_descripcion'=>'Junín','localidad_cp'=>5570,'provincia_id'=>1]);
        // $this->call(GradoDependenciaSeeder::class);
        DB::table('grado_dependencias')->insert(['gradodependenciaDescripcion'=>'Autoválido']);
        DB::table('grado_dependencias')->insert(['gradodependenciaDescripcion'=>'Severa']);
        // $this->call(MotivosEgresosSeeder::class);
        DB::table('motivos_egresos')->insert(['motivoegresoDescripcion'=>'Fallecimiento']);
        DB::table('motivos_egresos')->insert(['motivoegresoDescripcion'=>'Traslado a Domicilio']);
        DB::table('motivos_egresos')->insert(['motivoegresoDescripcion'=>'Traslado a II Nivel']);
        // $this->call(CamasSeeder::class);
        DB::table('camas')->insert(['NroHabitacion'=>0,'NroCama'=>0,'EstadoCama'=>0,'SexoCama'=>0]);
        DB::table('camas')->insert(['NroHabitacion'=>1,'NroCama'=>1,'EstadoCama'=>1,'SexoCama'=>1]);
        DB::table('camas')->insert(['NroHabitacion'=>1,'NroCama'=>2,'EstadoCama'=>1,'SexoCama'=>0]);
        DB::table('camas')->insert(['NroHabitacion'=>1,'NroCama'=>3,'EstadoCama'=>0,'SexoCama'=>1]);
        DB::table('camas')->insert(['NroHabitacion'=>2,'NroCama'=>4,'EstadoCama'=>0,'SexoCama'=>0]);
        // $this->call(PeriodoSeeder::class);
        DB::table('periodos')->insert(['nombreperiodo'=>'Mensual']);
        DB::table('periodos')->insert(['nombreperiodo'=>'Bimestral']);
        DB::table('periodos')->insert(['nombreperiodo'=>'Trimestral']);
        DB::table('periodos')->insert(['nombreperiodo'=>'Cuatrimestral']);
        DB::table('periodos')->insert(['nombreperiodo'=>'Semestral']);
        DB::table('periodos')->insert(['nombreperiodo'=>'Anual']);
        // $this->call(EscalaSeeder::class);
        DB::table('escalas')->insert(['nombreescala'=>'Lógica','tipodatos'=>'numerico','minimo'=>0,'maximo'=>1,'empresa_id'=>1]);
        DB::table('escalas')->insert(['nombreescala'=>'Numérica','tipodatos'=>'numerico','minimo'=>0,'maximo'=>1,'empresa_id'=>1]);
        DB::table('escalas')->insert(['nombreescala'=>'Porcentaje','tipodatos'=>'numerico','minimo'=>0,'maximo'=>100,'empresa_id'=>1]);
        // $this->call(SexoSeeder::class);
        DB::table('sexos')->insert(['nombresexo'=>'Masculino',]);
        DB::table('sexos')->insert(['nombresexo'=>'Femenino',]);
        DB::table('sexos')->insert(['nombresexo'=>'Prefiero no decirlo',]);

        // $this->call(AreasSeeder::class);
        DB::table('areas')->insert(['name'=>'Administración','empresa_id'=>1,'habilitada'=>1]);
        DB::table('areas')->insert(['name'=>'Médica','empresa_id'=>1,'habilitada'=>1]);
        DB::table('areas')->insert(['name'=>'Social','empresa_id'=>1,'habilitada'=>1]);
        DB::table('areas')->insert(['name'=>'Historia De Vida','empresa_id'=>1,'habilitada'=>1]);
        DB::table('areas')->insert(['name'=>'Pagos','empresa_id'=>1,'habilitada'=>1]);
        DB::table('areas')->insert(['name'=>'Nutricional','empresa_id'=>1,'habilitada'=>1]);
        
        
        // $this->call(PersonasCamposSeeder::class);
        
        // $this->call(ModuloSeeder::class);


        // $this->call(IvaSeeder::class);
        // \App\Models\erp\Persona::factory(10)->create();
        // \App\Models\erp\Camas::factory(20)->create();

        // DB::table('empresas')->insert(['name' => 'Empresa de Pruebas','direccion' => 'Dirección','cuit' => '20123456789','ib' => '012345678','imagen' => 'BarBer.png','establecimiento' => '0','telefono' => '12345678','actividad' => 'Desarrollo','actividad1' => 'Software','email' => '','habilitada' => true,'nombretitular' => 'Juan de los Palotes','dnititular' => '1234',]);

        //\App\Models\Empresa::factory(4)->create();   //Crea una empresa de prueba para relacionar con los usuarios que se dan de alta
        //\App\Models\Unidad::factory(10)->create();
        

    }
}
