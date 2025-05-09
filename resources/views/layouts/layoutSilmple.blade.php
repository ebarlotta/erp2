@extends('adminlte::page')
{{-- @extends('adminlte') --}}

@section('title', session('nombre_empresa'))
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
{{-- <script src="cart/js/taildwind.js"></script> --}}

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">


    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
        </li>



    </ul>


    <ul class="navbar-nav ml-auto">





        <li class="nav-item dropdown user-menu">


            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span>
                    enzogb
                </span>
            </a>


            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">








                <li class="user-footer">
                    <a href="http://localhost:8000/user/profile"
                        class="nav-link btn btn-default btn-flat d-inline-block">
                        <i class="fa fa-fw fa-user text-lightblue"></i>
                        Profile
                    </a>
                    <a class="btn btn-default btn-flat float-right " href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off text-red"></i>
                        Log Out
                    </a>
                    <form id="logout-form" action="http://localhost:8000/public/logout" method="POST"
                        style="display: none;">
                        <input type="hidden" name="_token" value="HxFFp6U8ZVZIs8hXsXWZNwa8XsJHlxHaGW3xRyAY"
                            autocomplete="off">
                    </form>
                </li>

            </ul>

        </li>


    </ul>

</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <a href="http://localhost:8000/empresas" class="brand-link ">


        <img src="http://localhost:8000/images/BarBer.png" alt="AdminLTE" class="brand-image img-circle elevation-3"
            style="opacity:.8">


        <span class="brand-text font-weight-light ">
            <div style="display:inline-block"><b>BarBer</b><br>
                <p style="font-size: 8px;">DESARROLLOS</p>
            </div>
        </span>

    </a>


    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">

                <li class="nav-header ">

                    GESTIÓN DE EMPRESAS

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            Administración
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/empresagestion">

                                <i class="fas fa-fw fa-building "></i>

                                <p>
                                    Gestión de empresas

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/empresamodulos">

                                <i class="fas fa-fw fa-chart-pie "></i>

                                <p>
                                    Módulos x Empresa

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/empresausuarios">

                                <i class="fas fa-fw fa-users "></i>

                                <p>
                                    Usuarios x Empresa

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/modulousuarios">

                                <i class="fas fa-fw fa-user-cog "></i>

                                <p>
                                    Usuarios x Módulo

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/roles">

                                <i class="fa fa-user-circle "></i>

                                <p>
                                    Gestión de Roles

                                </p>

                            </a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/actores">

                        <i class="fa fa-users "></i>

                        <p>
                            Actores

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/areas">

                        <i class="fa fa-cube "></i>

                        <p>
                            Areas

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/categorias">

                        <i class="fa fa-cubes "></i>

                        <p>
                            Categorías

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/cuentas">

                        <i class="fa fa-crosshairs "></i>

                        <p>
                            Cuentas

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/elementos">

                        <i class="fa fa-gift "></i>

                        <p>
                            Elementos

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/estados">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            Estados

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/estadosciviles">

                        <i class="fas fa-fw fa-venus-mars "></i>

                        <p>
                            Estados Civiles

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/proveedores">

                        <i class="fa fa-truck "></i>

                        <p>
                            Proveedores

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/tiposdedocumentos">

                        <i class="fa fa-server "></i>

                        <p>
                            Tipos de Documentos

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/unidades">

                        <i class="fa fa-thermometer-empty "></i>

                        <p>
                            Unidades

                        </p>

                    </a>

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fa fa-map-marker "></i>

                        <p>
                            Localización
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/localidades">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Localidades

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/nacionalidad">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Nacionalidades

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/provincias">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Provincias

                                </p>

                            </a>

                        </li>

                    </ul>

                </li>

                <li class="nav-header ">

                    ERP

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/categoriaproducto">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            Categorías de Productos

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/categoriaprofesional">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            Categorías Profesionales

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/clientes">

                        <i class="fas fa-users "></i>

                        <p>
                            Clientes

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/compras">

                        <i class="fas fa-fw fa-chart-pie "></i>

                        <p>
                            Compras

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/VentaSimple?Compras">

                        <i class="fas fa-fw fa-chart-pie "></i>

                        <p>
                            Compras Simple

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/empleados">

                        <i class="fas fa-users "></i>

                        <p>
                            Empleados

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/haberes">

                        <i class="fa fa-clone "></i>

                        <p>
                            Haberes

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/ventas">

                        <i class="fas fa-fw fa-chart-pie "></i>

                        <p>
                            Ventas

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/VentaSimple?Ventas">

                        <i class="fas fa-fw fa-chart-pie "></i>

                        <p>
                            Venta Simple

                        </p>

                    </a>

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fa fa-shopping-bag "></i>

                        <p>
                            Productos
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/producto/tag">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Agregar Etiqueta

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/producto/create">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Agregar Producto

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/producto">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Modificar / Eliminar

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/productos">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Gestión de Producto

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/productobajas">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Registrar Bajas

                                </p>

                            </a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000/tags">

                        <i class="fa fa-tags "></i>

                        <p>
                            Etiquetas

                        </p>

                    </a>

                </li>

                <li class="nav-header ">

                    GERI

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fas fa-fw fa-cogs "></i>

                        <p>
                            Ajustes
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview ">


                            <a class="nav-link  " href="">

                                <i class="fas fa-fw fa-cogs "></i>

                                <p>
                                    Gestión de Actores
                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>


                            <ul class="nav nav-treeview">
                                <li class="nav-item">

                                    <a class="nav-link  " href="http://localhost:8000/personactivo">

                                        <i class="fas fa-fw fa-bed "></i>

                                        <p>
                                            Estado de Actores

                                        </p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link  " href="http://localhost:8000/tiposdepersonas">

                                        <i class="fas fa-fw fa-object-group "></i>

                                        <p>
                                            Tipo de Actor

                                        </p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/beneficios">

                                <i class="fa fa-plus-square "></i>

                                <p>
                                    Beneficios

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/escolaridades">

                                <i class="fa fa-child "></i>

                                <p>
                                    Escolaridades

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/estadocama">

                                <i class="fas fa-fw fa-bed "></i>

                                <p>
                                    Estado de Camas

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/gradodependencia">

                                <i class="fas fa-fw fa-blind "></i>

                                <p>
                                    Grado de Dependencia

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/habitaciones">

                                <i class="fas fa-fw fa-bed "></i>

                                <p>
                                    Habitaciones

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/medicamentos">

                                <i class="fa fa-table "></i>

                                <p>
                                    Medicamentos

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/motivoegreso">

                                <i class="fa fa-arrow-down "></i>

                                <p>
                                    Motivos de Egresos

                                </p>

                            </a>

                        </li>

                        <li class="nav-item has-treeview ">


                            <a class="nav-link  " href="">

                                <i class="fa fa-cutlery "></i>

                                <p>
                                    Gestión Menú
                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>


                            <ul class="nav nav-treeview">
                                <li class="nav-item">

                                    <a class="nav-link  " href="http://localhost:8000/elementos">

                                        <i class="far fa-fw fa-circle "></i>

                                        <p>
                                            Ingredientes

                                        </p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link  " href="http://localhost:8000/menu">

                                        <i class="far fa-fw fa-circle "></i>

                                        <p>
                                            Menúes

                                        </p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link  " href="http://localhost:8000/expendio">

                                        <i class="far fa-fw fa-circle "></i>

                                        <p>
                                            Expendio

                                        </p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </li>

                <li class="nav-header ">

                    GESTIÓN INFORMES

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            Informes
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/tablas">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Permisos a Informes

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/tablasver">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Visualizar Informes

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/tablas-edit">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Editar/Eliminar Informes

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/tablas-disenar">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Diseñar Informes

                                </p>

                            </a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item has-treeview ">


                    <a class="nav-link  " href="">

                        <i class="fas fa-fw fa-cogs "></i>

                        <p>
                            Generales
                            <i class="fas fa-angle-left right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/otrascosas">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Otras Cosas

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/user/profile">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Usuario

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/personascampos">

                                <i class="fas fa-fw fa-child  "></i>

                                <p>
                                    Personas Campos

                                </p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link  " href="http://localhost:8000/interfaces">

                                <i class="far fa-fw fa-circle "></i>

                                <p>
                                    Gestión de Interfaces

                                </p>

                            </a>

                        </li>

                    </ul>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="http://localhost:8000">

                        <i class="fas fa-fw fa-building "></i>

                        <p>
                            VOLVER

                        </p>

                    </a>

                </li>

            </ul>
        </nav>
    </div>

</aside>

<div class="content-wrapper" >






    <div class="content">
        <div class="container-fluid">
            <div wire:snapshot="{&quot;data&quot;:{&quot;areas&quot;:[null,{&quot;keys&quot;:[157,158,164,169,166,162,167,160,159,165,161,163,168],&quot;class&quot;:&quot;Illuminate\\Database\\Eloquent\\Collection&quot;,&quot;modelClass&quot;:&quot;App\\Models\\Area&quot;,&quot;s&quot;:&quot;elcln&quot;}],&quot;cuentas&quot;:[null,{&quot;keys&quot;:[244,245,250,249,241,242,246,243,251,248,247],&quot;class&quot;:&quot;Illuminate\\Database\\Eloquent\\Collection&quot;,&quot;modelClass&quot;:&quot;App\\Models\\Cuenta&quot;,&quot;s&quot;:&quot;elcln&quot;}],&quot;clientes&quot;:[null,{&quot;keys&quot;:[220],&quot;class&quot;:&quot;Illuminate\\Database\\Eloquent\\Collection&quot;,&quot;modelClass&quot;:&quot;App\\Models\\erp\\Cliente&quot;,&quot;s&quot;:&quot;elcln&quot;}],&quot;proveedores&quot;:[null,{&quot;keys&quot;:[2611,2617,2600,2610,2613,2618,2612,2614,2606,2601,2616,2595,2605,2604,2597,2599,2615,2598,2603,2602,2609,2620,2619,2607,2596,2608],&quot;class&quot;:&quot;Illuminate\\Database\\Eloquent\\Collection&quot;,&quot;modelClass&quot;:&quot;App\\Models\\Proveedor&quot;,&quot;s&quot;:&quot;elcln&quot;}],&quot;ivas&quot;:[null,{&quot;keys&quot;:[1,2,3,4],&quot;class&quot;:&quot;Illuminate\\Database\\Eloquent\\Collection&quot;,&quot;modelClass&quot;:&quot;App\\Models\\Iva&quot;,&quot;s&quot;:&quot;elcln&quot;}],&quot;detalle&quot;:null,&quot;area&quot;:null,&quot;cuenta&quot;:null,&quot;cliente&quot;:null,&quot;proveedor&quot;:null,&quot;fecha_simple&quot;:&quot;2025-05-09&quot;,&quot;monto_simple&quot;:null,&quot;partiva_simple&quot;:null,&quot;area_simple&quot;:null,&quot;cuenta_simple&quot;:null,&quot;cliente_simple&quot;:null,&quot;proveedor_simple&quot;:null,&quot;iva_simple&quot;:1,&quot;ModalGuardado&quot;:false,&quot;modulo&quot;:&quot;Compras&quot;},&quot;memo&quot;:{&quot;id&quot;:&quot;LMSEchVn40diMKi25Q7J&quot;,&quot;name&quot;:&quot;erp.compra.compra-simple-component&quot;,&quot;path&quot;:&quot;VentaSimple&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;},&quot;checksum&quot;:&quot;9cf1294fc7f7d8a1798bd7c30af3ae481561491ee2ab70c54674c8a027c89073&quot;}"
                wire:effects="[]" wire:id="LMSEchVn40diMKi25Q7J">

                <meta charset="UTF-8">
                <meta name="viewport"
                    content="width=device-width, user-scaable=no, initial-scale=1.0 maximum-scale=1.0, minimum-scale=1.0">
                <title>MCR Soft</title>
                <link rel="stylesheet" href="/css/estilosMario.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                    crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                </script>
                <!-- incorporacion de Letra Jockey One -->


                <!-- <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                    crossorigin="anonymous">


                <!--     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  -->




                <!-- desde aca o anterior -->

                <div>
                    <div class="text-center">
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        <div class="pelotero">

                            <a href="VentaSimple?Compras">
                                <div class="pelotitaE">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                        fill="currentColor" class="bi bi-emoji-astonished-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.884-3.978a2.1 2.1 0 0 1 .53.332.5.5 0 0 0 .708-.708h-.001v-.001a2 2 0 0 0-.237-.197 3 3 0 0 0-.606-.345 3 3 0 0 0-2.168-.077.5.5 0 1 0 .316.948 2 2 0 0 1 1.458.048m-4.774-.048a.5.5 0 0 0 .316-.948 3 3 0 0 0-2.167.077 3.1 3.1 0 0 0-.773.478q-.036.03-.07.064l-.002.001a.5.5 0 1 0 .728.689 2 2 0 0 1 .51-.313 2 2 0 0 1 1.458-.048M7 6.5C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5m4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5m-5.247 4.746c-.383.478.08 1.06.687.98q1.56-.202 3.12 0c.606.08 1.07-.502.687-.98C9.747 10.623 8.998 10 8 10s-1.747.623-2.247 1.246">
                                        </path>
                                    </svg>
                                </div>
                            </a>
                            <div class="col-1"></div>

                            <div class="pelotitaI">
                                <a href="VentaSimple?Ventas">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                        fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M11.315 10.014a.5.5 0 0 1 .548.736A4.5 4.5 0 0 1 7.965 13a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242s1.46-.118 2.152-.242a27 27 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434m6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434">
                                        </path>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-1"></div>
                            <div class="pelotitaP">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                    <path d="M2 2h2v2H2z"></path>
                                    <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"></path>
                                    <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"></path>
                                    <path
                                        d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z">
                                    </path>
                                    <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"></path>
                                </svg>
                            </div>

                        </div>

                        <input wire:model="monto_simple" class="Monto" type="text" placeholder="Monto $"
                            autofocus=""><br>

                        <input class="fecha" type="date" value="2025-05-09" placeholder="dd/mm/aaaa"><br>
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        <!-- Botón para abrir el formulario emergente -->

                        <!-- Cliente -->
                        <!--[if BLOCK]><![endif]--> <select class="Proveedores" wire:model="proveedor_simple">
                            <option value="">Seleccione un Proveedor</option>
                            <!--[if BLOCK]><![endif]-->
                            <option value="2611">Aguas Mendocinas</option>
                            <option value="2617">Alquileres</option>
                            <option value="2600">Anses</option>
                            <option value="2610">Banco Nación</option>
                            <option value="2613">Claro</option>
                            <option value="2618">Colegio La Compasión</option>
                            <option value="2612">Ecogas</option>
                            <option value="2614">Edeste</option>
                            <option value="2606">Escuela de Fútbol ofradía</option>
                            <option value="2601">Galicia</option>
                            <option value="2616">Impuesto Automotor</option>
                            <option value="2595">Instituto 9021</option>
                            <option value="2605">Instituto Leader</option>
                            <option value="2604">Maestría Universidad de Córdoba UNC</option>
                            <option value="2597">Mastercard</option>
                            <option value="2599">Mercado Pago</option>
                            <option value="2615">Municipalidad</option>
                            <option value="2598">Naranja</option>
                            <option value="2603">Profesorado UCH</option>
                            <option value="2602">San Pio X</option>
                            <option value="2609">Sucesión Vicente Barlotta</option>
                            <option value="2620">UDA</option>
                            <option value="2619">Universidad Champagnat</option>
                            <option value="2607">Universidad del Aconcagua</option>
                            <option value="2596">Visa</option>
                            <option value="2608">Yoga</option>
                            <!--[if ENDBLOCK]><![endif]-->
                        </select>
                        <!--[if ENDBLOCK]><![endif]-->
                        <br>

                        <!-- Area -->
                        <select class="areas" wire:model="area_simple">
                            <option value="">Seleccione un Área</option>
                            <!--[if BLOCK]><![endif]-->
                            <option value="157">Alquiler</option>
                            <option value="158">Educación</option>
                            <option value="164">Enzo</option>
                            <option value="169">Familia</option>
                            <option value="166">Francisco</option>
                            <option value="162">Ocio</option>
                            <option value="167">Paula</option>
                            <option value="160">Préstamos</option>
                            <option value="159">Servicios</option>
                            <option value="165">Silvina</option>
                            <option value="161">Sueldos</option>
                            <option value="163">Tarjetas</option>
                            <option value="168">Valentino</option>
                            <!--[if ENDBLOCK]><![endif]-->
                        </select>
                        <br>

                        <!-- Cuenta  -->
                        <select class="cuentas" wire:model="cuenta_simple">
                            <option value="">Seleccione una Cuenta</option>
                            <!--[if BLOCK]><![endif]-->
                            <option value="244">Agua</option>
                            <option value="245">Celulares</option>
                            <option value="250">Educación</option>
                            <option value="249">Efectivo </option>
                            <option value="241">Electricidad</option>
                            <option value="242">Gas</option>
                            <option value="246">Inmobiliario</option>
                            <option value="243">Internet</option>
                            <option value="251">Internet</option>
                            <option value="248">Monotributo</option>
                            <option value="247">Seguros</option>
                            <!--[if ENDBLOCK]><![endif]-->
                        </select>
                        <br>

                        <!-- Destacado de Ingresos  -->
                    </div>
                    <!--[if BLOCK]><![endif]-->
                    <div class="col-12 grid justify-center">
                        <div class="flex d-flex">
                            <input class="form-control w-full mb-2" type="text" wire:model="detalle"
                                value="" placeholder="Detalle [Opcional]">
                            <div class="flex d-flex text-center"
                                style="border: 1px solid lightgray; height: min-content;border-radius: 10px;padding: 5px 5px 0px 6px;margin-left: 10px;">
                                <label><b>Pagado</b></label><br>
                                <input type="checkbox" wire:model="chkPagado" checked=""
                                    style="height:min-content;margin-top: 5px;margin-left: 3px;">
                            </div>
                        </div>
                        <div class="block text-center">
                            <label class="text-brown font-bold">Egresos</label>
                            <button class="btn btn-primary mt-2" type="button" wire:click="GuardarCompraSimple"
                                wire:loading.attr="disabled">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->
                </div>



                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
                </script>

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

</div>
