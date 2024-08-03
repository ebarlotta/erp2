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
        DB::table('modulos')->insert(['name' => 'Empresas', 'pagina' => 'empresagestion','imagen'=>'empresa.jpg','leyenda'=>'ABM de Empresas.']);    
        DB::table('modulos')->insert(['name' => 'Unidades', 'pagina' => 'unidades','imagen'=>'unidades.jpg','leyenda'=>'Permite individualizar a cada producto con sus unidades de medida precisa a la hora de tener un control del stock de los mismos.']);
        DB::table('modulos')->insert(['name' => 'Cuentas', 'pagina' => 'cuentas','imagen'=>'cuentas.jpg','leyenda'=>'Divida los movimientos en distintas cuentas contables que puede utilizar para filtrar información.']);
        DB::table('modulos')->insert(['name' => 'Areas', 'pagina' => 'areas','imagen'=>'areas.jpg','leyenda'=>'Genere áreas/sectores/unidades de negocio de su organización para poder llevar un control más detallado.']);

        DB::table('modulos')->insert(['name' => 'Clientes', 'pagina' => 'clientes','imagen'=>'clientes.jpg','leyenda'=>'Agregue nuevos clientes o modifique los datos ya ingresados.']);    //erp 
        DB::table('modulos')->insert(['name' => 'Compras', 'pagina' => 'compras','imagen'=>'compras.jpg','leyenda'=>'Registre todos los comprobantes de las compras/gastos realizados. Ingrese al stock los productos adquiridos.']);   //erp 
        DB::table('modulos')->insert(['name' => 'Empleados', 'pagina' => 'empleados','imagen'=>'empleados.jpg','leyenda'=>'Realice altas, modificaciones, y bajas del personal que desarrolla las actividades en su organización.']);   //erp 
        DB::table('modulos')->insert(['name' => 'Proveedores', 'pagina' => 'proveedores','imagen'=>'proveedores.jpg','leyenda'=>'Registre, modifique o elimine información de sus proveedores. Registre email y números de teléfonos de los mismos.']); //erp 
        DB::table('modulos')->insert(['name' => 'Ventas', 'pagina' => 'ventas','imagen'=>'ventas.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo. Envíe la información a los distintos organismos.']);   //erp 
        DB::table('modulos')->insert(['name' => 'Productos', 'pagina' => 'productos','imagen'=>'productos.jpg','leyenda'=>'Agregue productos para su empresa, los mismos aparecerán en su carrito de compras de la empresa. Venda esos roductos.']);    //erp 
        DB::table('modulos')->insert(['name' => 'Informes', 'pagina' => 'tablas-ver','imagen'=>'informes.jpg','leyenda'=>'Genere informes resumidos de los movimientos de compras, ventas y demás. Son herramientas empresariales claves para a gestión de su empresa.']);  //erp 
        DB::table('modulos')->insert(['name' => 'Etiquetas', 'pagina' => 'tags','imagen'=>'tags.jpg','leyenda'=>'Identifique sus productos mediante etiquetas para que sus clientes encuentren más facilmente los productos a la hora de realizar una compra.']);    //erp 
        DB::table('modulos')->insert(['name' => 'Categorías de Productos', 'pagina' => 'categoriaproducto','imagen'=>'categoriaproductos.jpg','leyenda'=>'Agrupe sus productos mediante categorías para una búsqueda más dinámica.']);  //erp         
        DB::table('modulos')->insert(['name' => 'Estados', 'pagina' => 'estados','imagen'=>'estados.jpg','leyenda'=>'Los productos pueden cambiar de estados ya que pueden ser nuevos, usados o ser eliminado por algún motivo.']);    //erp         
        DB::table('modulos')->insert(['name' => 'Haberes', 'pagina' => 'haberes','imagen'=>'haberes.jpg','leyenda'=>'Calcule las liquidaciones de haberes de su personal. Revise liquidaciones de períodos anteriores.']);  //erp         
        DB::table('modulos')->insert(['name' => 'Ventas Mostrador', 'pagina' => 'ventasmostrador','imagen'=>'ventasmostrador.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo.']);    //erp         

        DB::table('modulos')->insert(['name' => 'Provincias', 'pagina' => 'provincias','imagen'=>'estados.jpg','leyenda'=>'Registre las provincias.']);  // Geri
        DB::table('modulos')->insert(['name' => 'Grado de pendencia', 'pagina' => 'gradodependencia','imagen'=>'dependencia.jpg','leyenda'=>'Resgitre el estado de dependencia de una persona.']);  // Geri
        DB::table('modulos')->insert(['name' => 'Motivo de Egreso', 'pagina' => 'motivoegreso','imagen'=>'egresos.jpg','leyenda'=>'Diversos motivos por los cuales la persona no continua en el lugar.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Estado de Cama', 'pagina' => 'estadocama','imagen'=>'estadocama.jpg','leyenda'=>'Estado individual de cada una de las camas en la institución.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Habitaciones', 'pagina' => 'habitaciones','imagen'=>'habitacion.jpg','leyenda'=>'Cada una de las habitaciones en la institución y si está habilitada o no.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Personas Campos', 'pagina' => 'personascampos','imagen'=>'haberes.jpg','leyenda'=>'Distintintos campos utilizados a una persona.']);   // Geri
        DB::table('modulos')->insert(['name' => 'Interfaces', 'pagina' => 'interfaces','imagen'=>'interfaces.jpg','leyenda'=>'Generación de interfaces necesarias para la aplicación diseñada.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Categorias', 'pagina' => 'categorias','imagen'=>'categorias.jpg','leyenda'=>'Configure las distintas categorias de Ingredientes.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Ingredientes', 'pagina' => 'ingredientes','imagen'=>'ingredientes.jpg','leyenda'=>'Calcule las liquidaciones de haberes de su personal. Revise liquidaciones de períodos anteriores.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Menú', 'pagina' => 'menu','imagen'=>'menu.jpg','leyenda'=>'Gestione los distintos menúes a servir.']);    // Geri
        DB::table('modulos')->insert(['name' => 'otrascosas', 'pagina' => 'otrascosas','imagen'=>'haberes.jpg','leyenda'=>'Otras cosas.']);    // Geri
        DB::table('modulos')->insert(['name' => 'Perfil', 'pagina' => 'profile','imagen'=>'haberes.jpg','leyenda'=>'Modifique los datos personales.']);   // Geri
    
    }
}
