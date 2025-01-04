<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert(['name' => 'Empresas', 'pagina' => 'empresagestion','imagen'=>'empresa.jpg','leyenda'=>'ABM de Empresas.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Módulos x Empresa', 'pagina' => 'empresamodulos','imagen'=>'empresamodulos.jpg','leyenda'=>'ABM de Módulos x Empresa.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Gestión de Módulos', 'pagina' => 'gestionmodulo','imagen'=>'gestionmodulos.jpg','leyenda'=>'Gestión de Módulos.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Usuarios x Empresa', 'pagina' => 'empresausuarios','imagen'=>'empresausuarios.jpg','leyenda'=>'Gestión de Usuarios x Empresa.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Módulos x Usuario', 'pagina' => 'modulousuarios','imagen'=>'modulousuarios.jpg','leyenda'=>'Gestión de Módulos x Usuarios.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Roles', 'pagina' => 'roles','imagen'=>'roles.jpg','leyenda'=>'Gestión de Roles.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Certificados', 'pagina' => 'certificado','imagen'=>'certificados.jpg','leyenda'=>'Gestión de Certificados.','habilitado'=>1]);
        

        DB::table('modulos')->insert(['name' => 'Unidades', 'pagina' => 'unidades','imagen'=>'unidades.jpg','leyenda'=>'Permite individualizar a cada producto con sus unidades de medida precisa a la hora de tener un control del stock de los mismos.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Cuentas', 'pagina' => 'cuentas','imagen'=>'cuentas.jpg','leyenda'=>'Divida los movimientos en distintas cuentas contables que puede utilizar para filtrar información.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Areas', 'pagina' => 'areas','imagen'=>'areas.jpg','leyenda'=>'Genere áreas/sectores/unidades de negocio de su organización para poder llevar un control más detallado.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Elementos', 'pagina' => 'elementos','imagen'=>'elementos.jpg','leyenda'=>'Gestione distintos tipos de elementos a utilizar dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Estados_Civiles', 'pagina' => 'estadosciviles','imagen'=>'estadosciviles.jpg','leyenda'=>'Gestione distintos tipos de Estados civiles de las personas dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Tipos_de_documentos', 'pagina' => 'tiposdedocumentos','imagen'=>'tiposdedocumentos.jpg','leyenda'=>'Gestione distintos tipos de Documentos dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Localidades', 'pagina' => 'localidades','imagen'=>'localidades.jpg','leyenda'=>'Gestione las distintas localidades dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Nacionalidad', 'pagina' => 'nacionalidad','imagen'=>'nacionalidad.jpg','leyenda'=>'Gestione distintos tipos de Nacionalidades dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Provincias', 'pagina' => 'provincias','imagen'=>'provincias.jpg','leyenda'=>'Gestione distintas Provincias dentro del sistema.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Actores', 'pagina' => 'actores','imagen'=>'actores.jpg','leyenda'=>'En este módulo se podrán gestionar todos los actores que participan en el sistema, tales como Clientes, Proveedores, Empleados.','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Listas', 'pagina' => 'listas','imagen'=>'listas.jpg','leyenda'=>'Cree, modifique y elimine listas de precios para distintos tipos de clientes','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Categorías Profesionales', 'pagina' => 'categoriaprofesional','imagen'=>'categoriaprofesional.jpg','leyenda'=>'Gestiona las categorías profesionales de los empleados','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Beneficios', 'pagina' => 'beneficios','imagen'=>'beneficios.jpg','leyenda'=>'Gestiona los distintos tipos de beneficios/obras sociales','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Escolaridades', 'pagina' => 'escolaridades','imagen'=>'escolaridades.jpg','leyenda'=>'Gestiona las escolaridades de las personas','habilitado'=>1]);
        DB::table('modulos')->insert(['name' => 'Tablas/Informes', 'pagina' => 'tablas','imagen'=>'tablas.jpg','leyenda'=>'Gestiona informes','habilitado'=>1]);
        // DB::table('modulos')->insert(['name' => 'Provincias', 'pagina' => 'provincias','imagen'=>'estados.jpg','leyenda'=>'Registre las provincias.','habilitado'=>1]);
        
        DB::table('modulos')->insert(['name' => 'Clientes', 'pagina' => 'clientes','imagen'=>'clientes.jpg','leyenda'=>'Agregue nuevos clientes o modifique los datos ya ingresados.','habilitado'=>1]);    //erp 
        DB::table('modulos')->insert(['name' => 'Compras', 'pagina' => 'compras','imagen'=>'compras.jpg','leyenda'=>'Registre todos los comprobantes de las compras/gastos realizados. Ingrese al stock los productos adquiridos.','habilitado'=>1]);   //erp 
        DB::table('modulos')->insert(['name' => 'Empleados', 'pagina' => 'empleados','imagen'=>'empleados.jpg','leyenda'=>'Realice altas, modificaciones, y bajas del personal que desarrolla las actividades en su organización.','habilitado'=>1]);   //erp 
        DB::table('modulos')->insert(['name' => 'Proveedores', 'pagina' => 'proveedores','imagen'=>'proveedores.jpg','leyenda'=>'Registre, modifique o elimine información de sus proveedores. Registre email y números de teléfonos de los mismos.','habilitado'=>1]); //erp 
        DB::table('modulos')->insert(['name' => 'Ventas', 'pagina' => 'ventas','imagen'=>'ventas.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo. Envíe la información a los distintos organismos.','habilitado'=>1]);   //erp 
        DB::table('modulos')->insert(['name' => 'Productos', 'pagina' => 'productos','imagen'=>'productos.jpg','leyenda'=>'Agregue productos para su empresa, los mismos aparecerán en su carrito de compras de la empresa. Venda esos roductos.','habilitado'=>1]);    //erp 
        DB::table('modulos')->insert(['name' => 'Informes', 'pagina' => 'tablasver','imagen'=>'informes.jpg','leyenda'=>'Genere informes resumidos de los movimientos de compras, ventas y demás. Son herramientas empresariales claves para a gestión de su empresa.','habilitado'=>1]);  //erp 
        DB::table('modulos')->insert(['name' => 'Etiquetas', 'pagina' => 'tags','imagen'=>'tags.jpg','leyenda'=>'Identifique sus productos mediante etiquetas para que sus clientes encuentren más facilmente los productos a la hora de realizar una compra.','habilitado'=>1]);    //erp 
        DB::table('modulos')->insert(['name' => 'Categorías de Productos', 'pagina' => 'categoriaproducto','imagen'=>'categoriaproductos.jpg','leyenda'=>'Agrupe sus productos mediante categorías para una búsqueda más dinámica.','habilitado'=>1]);  //erp         
        DB::table('modulos')->insert(['name' => 'Estados', 'pagina' => 'estados','imagen'=>'estados.jpg','leyenda'=>'Los productos pueden cambiar de estados ya que pueden ser nuevos, usados o ser eliminado por algún motivo.','habilitado'=>1]);    //erp         
        DB::table('modulos')->insert(['name' => 'Haberes', 'pagina' => 'haberes','imagen'=>'haberes.jpg','leyenda'=>'Calcule las liquidaciones de haberes de su personal. Revise liquidaciones de períodos anteriores.','habilitado'=>1]);  //erp         
        DB::table('modulos')->insert(['name' => 'Ventas Mostrador', 'pagina' => 'ventasmostrador','imagen'=>'ventasmostrador.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo.','habilitado'=>1]);    //erp         
        
        DB::table('modulos')->insert(['name' => 'Categorias', 'pagina' => 'categorias','imagen'=>'categorias.jpg','leyenda'=>'Configure las distintas categorias de Ingredientes.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Estado de Cama', 'pagina' => 'estadocama','imagen'=>'estadocama.jpg','leyenda'=>'Estado individual de cada una de las camas en la institución.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Grado de pendencia', 'pagina' => 'gradodependencia','imagen'=>'dependencia.jpg','leyenda'=>'Resgitre el estado de dependencia de una persona.','habilitado'=>1]);  // Geri
        DB::table('modulos')->insert(['name' => 'Habitaciones', 'pagina' => 'habitaciones','imagen'=>'habitacion.jpg','leyenda'=>'Cada una de las habitaciones en la institución y si está habilitada o no.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Ingredientes', 'pagina' => 'ingredientes','imagen'=>'ingredientes.jpg','leyenda'=>'Calcule las liquidaciones de haberes de su personal. Revise liquidaciones de períodos anteriores.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Interfaces', 'pagina' => 'interfaces','imagen'=>'interfaces.jpg','leyenda'=>'Generación de interfaces necesarias para la aplicación diseñada.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Medicamentos', 'pagina' => 'medicamentos','imagen'=>'medicamentos.jpg','leyenda'=>'Administre nombres y tipos de medicamentos.','habilitado'=>1]);  // Geri
        DB::table('modulos')->insert(['name' => 'Menú', 'pagina' => 'menu','imagen'=>'menu.jpg','leyenda'=>'Gestione los distintos menúes a servir.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Motivo de Egreso', 'pagina' => 'motivoegreso','imagen'=>'egresos.jpg','leyenda'=>'Diversos motivos por los cuales la persona no continua en el lugar.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Personas Campos', 'pagina' => 'personascampos','imagen'=>'haberes.jpg','leyenda'=>'Distintintos campos utilizados a una persona.','habilitado'=>1]);   // Geri
        DB::table('modulos')->insert(['name' => 'otrascosas', 'pagina' => 'otrascosas','imagen'=>'haberes.jpg','leyenda'=>'Otras cosas.','habilitado'=>1]);    // Geri
        DB::table('modulos')->insert(['name' => 'Perfil', 'pagina' => 'profile','imagen'=>'haberes.jpg','leyenda'=>'Modifique los datos personales.','habilitado'=>1]);   // Geri
        DB::table('modulos')->insert(['name' => 'Tipos de Personas', 'pagina' => 'tiposdepersonas','imagen'=>'tiposdepersonas.jpg','leyenda'=>'Administra los distintos actores/personas dentro del sistema.','habilitado'=>1]);   // Geri
    }
}
