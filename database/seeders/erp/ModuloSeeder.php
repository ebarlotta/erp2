<?php

namespace Database\Seeders\erp;

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
        DB::table('modulos')->insert(['name' => 'Clientes', 'pagina' => 'clientes','imagen'=>'clientes.jpg','leyenda'=>'Agregue nuevos clientes o modifique los datos ya ingresados.']);
        DB::table('modulos')->insert(['name' => 'Compras', 'pagina' => 'compras','imagen'=>'proveedores.jpg','leyenda'=>'Registre todos los comprobantes de las compras/gastos realizados. Ingrese al stock los productos adquiridos.']);
        DB::table('modulos')->insert(['name' => 'Empleados', 'pagina' => 'empleados','imagen'=>'empleados.jpg','leyenda'=>'Realice altas, modificaciones, y bajas del personal que desarrolla las actividades en su organización.']);
        DB::table('modulos')->insert(['name' => 'Proveedores', 'pagina' => 'proveedores','imagen'=>'proveedores.jpg','leyenda'=>'Registre, modifique o elimine información de sus proveedores. Registre email y números de teléfonos de los mismos.']);
        DB::table('modulos')->insert(['name' => 'Ventas', 'pagina' => 'ventas','imagen'=>'ventas.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo. Envíe la información a los distintos organismos.']);
        DB::table('modulos')->insert(['name' => 'Productos', 'pagina' => 'productos','imagen'=>'productos.jpg','leyenda'=>'Agregue productos para su empresa, los mismos aparecerán en su carrito de compras de la empresa. Venda esos roductos.']);
        DB::table('modulos')->insert(['name' => 'Informes', 'pagina' => 'tablasver','imagen'=>'informes.jpg','leyenda'=>'Genere informes resumidos de los movimientos de compras, ventas y demás. Son herramientas empresariales claves para a gestión de su empresa.']);
        DB::table('modulos')->insert(['name' => 'Etiquetas', 'pagina' => 'tags','imagen'=>'tags.jpg','leyenda'=>'Identifique sus productos mediante etiquetas para que sus clientes encuentren más facilmente los productos a la hora de ealizar una compra.']);
        DB::table('modulos')->insert(['name' => 'Categorías de Productos', 'pagina' => 'categoriaproducto','imagen'=>'categoriaproductos.jpg','leyenda'=>'Agrupe sus productos mediante categorías para una búsqueda más dinámica.']);        
        DB::table('modulos')->insert(['name' => 'Estados', 'pagina' => 'estados','imagen'=>'estados.jpg','leyenda'=>'Los productos pueden cambiar de estados ya que pueden ser nuevos, usados o ser eliminado por alguún motivo.']);        
        DB::table('modulos')->insert(['name' => 'Haberes', 'pagina' => 'haberes','imagen'=>'haberes.jpg','leyenda'=>'Calcule las liquidaciones de haberes de su personal. Revise liquidaciones de períodos anteriores.']);        
        DB::table('modulos')->insert(['name' => 'Ventas Mostrador', 'pagina' => 'ventasmostrador','imagen'=>'ventasmostrador.jpg','leyenda'=>'Registre comprobantes de ventas, consulte informes en distintas escalas de tiempo.']);        
    }
}
