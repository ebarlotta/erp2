<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => session('nombre_empresa'), //'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<div style="display:inline-block"><b>BarBer</b><br><p style="font-size: 8px;">DESARROLLOS</p></div>',
    // 'logo' => '<div style="display:inline-block"><b>BarBer</b><br><p style="font-size: 8px;">DESARROLLOS</p></div>',
    // 'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img' => 'images/BarBer.png',
    // session('empresa_id');
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/empresas',
    'logout_url' => 'public/public/logout',
    'login_url' => 'public/login',
    'register_url' => 'register',
    'password_reset_url' => 'public/|password/reset',
    'password_email_url' => 'public/|password/email',
    'profile_url' => 'user/profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],
        // [
        //     'type'         => 'fullscreen-widget',
        //     'topnav_right' => true,
        // ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'search',
        // ],
        [
            'text' => 'blog',
            'url'  => 'blog',
//            'can'  => 'manage-blog',
        ],
        // [
        //     'text'        => 'Las paginaspages',
        //     'url'         => '#',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 6,
        //     'label_color' => 'success',
        // ],
        
        // ['header' => 'account_settings'],
        ['header' => 'GESTIÓN DE EMPRESAS',
//            'can' => 'administracion.Ver',
        ],
        
        [
            'canany' => ['empresagestion.Ver','empresamodulos.Ver','gestionmodulos.Ver','modulousuarios.Ver','roles.Ver','certificados.Ver'],
            'text' => 'Administración',
            'url'  => 'tags',
            'icon' => 'fas fa-fw fa-building',
            'submenu' => [
                [
                    'text' => 'Gestión de empresas',
                    'url'  => 'empresagestion',
                    'icon' => 'fas fa-fw fa-building',
                    'can' => 'empresagestion.Ver',
                ],
                [
                    'text' => 'Módulos x Empresa',
                    'url'  => 'empresamodulos',
                    'icon' => 'fas fa-fw fa-chart-pie',
                    'can' => 'empresamodulos.Ver',
                ],
                [
                    'text' => 'Gestión de Módulos',
                    'url'  => 'gestionmodulos',
                    'icon' => 'fas fa-fw fa-building',
                    'can' => 'gestionmodulo.Ver',
                ],
                [
                    'text' => 'Usuarios x Empresa',
                    'url'  => 'empresausuarios',
                    'icon' => 'fas fa-fw fa-users',
                    'can' => 'empresausuarios.Ver',
                ],
                [
                    'text' => 'Usuarios x Módulo',
                    'url'  => 'modulousuarios',
                    'icon' => 'fas fa-fw fa-user-cog',
                    'can' => 'modulousuarios.Ver',
                ],
                [
                    'text' => 'Gestión de Roles',
                    'url'  => 'roles',
                    'icon' => 'fas fa-fw fa-building',
                    'can' => 'roles.Ver',
                ],
                [
                    'text' => 'Gestión de Certificados',
                    'url'  => 'certificados',
                    'icon' => 'fa fa-certificate',
                    'can' => 'certificado.Ver',
                ],
            ],
        ],
            [
                'text' => 'Actores',
                'url'  => 'actores',
                'icon' => 'fa fa-users',
                'can' => 'actores.Ver',
            ],
            [
                'text' => 'Areas',
                'url'  => 'areas',
                'icon' => 'fa fa-cube',
                'can' => 'areas.Ver',
            ],
            [
                'text' => 'Categorías',
                'url'  => 'categorias',
                'icon' => 'fa fa-cubes',
                'can' => 'categorias.Ver',
            ],    
            [
                'text' => 'Cuentas',
                'url'  => 'cuentas',
                'icon' => 'fa fa-crosshairs',
                'can' => 'cuentas.Ver',
            ],
            [
                'text' => 'Elementos',
                'url'  => 'elementos',
                'icon' => 'fas fa-fw fa-building',
                'can' => 'elementos.Ver',
            ],
            [
                'text' => 'Estados',
                'url'  => 'estados',
                'icon' => 'fas fa-fw fa-building',
                'can' => 'estados.Ver',
            ],                
            [
                'text' => 'Estados Civiles',
                'url'  => 'estadosciviles',
                'icon' => 'fas fa-fw fa-venus-mars',
                'can' => 'estadosciviles.Ver',
            ],
            [
                'text' => 'Listas',
                'url'  => 'listas',
                'icon' => 'fa fa-clone',
                'can' => 'listas.Ver',
            ],
            [
                'text' => 'Proveedores',
                'url'  => 'proveedores',
                'icon' => 'fa fa-truck',
                'can' => 'proveedores.Ver',
            ],
            [
                'text' => 'Tipos de Documentos',
                'url'  => 'tiposdedocumentos',
                'icon' => 'fa fa-server',
                'can' => 'tiposdedocumentos.Ver',
            ],     
            [
                'text' => 'Unidades',
                'url'  => 'unidades',
                'icon' => 'fa fa-thermometer-empty',
                'can' => 'unidades.Ver',
            ],
            [
                'text' => 'Localización',
                'icon' => 'fa fa-arrows',
                'canany' => ['localidades.Ver','nacionalidad.Ver','provincias.Ver'],
                'submenu' => [
                    [
                        'text' => 'Localidades',
                        'url'  => 'localidades',
                        'can' => 'localidades.Ver',
                    ],
                    [
                        'text' => 'Nacionalidades',
                        'url'  => 'nacionalidad',
                        'can' => 'nacionalidad.Ver',
                    ],
                    [
                        'text' => 'Provincias',
                        'url'  => 'provincias',
                        'can' => 'provincias.Ver',
                    ],
                ],
            ],        

        ['header' => 'ERP',
//            'can' => 'administracion.Ver',
        ],
        [
            'text' => 'Categorías de Productos',
            'url'  => 'categoriaproducto',
            'icon' => 'fas fa-fw fa-building',
            'can' => 'categoriaproducto.Ver',
        ],        
        [
            'text' => 'Categorías Profesionales',
            'url'  => 'categoriaprofesional',
            'icon' => 'fas fa-fw fa-building',
            'can' => 'categoriaprofesional.Ver',
        ],
        [
            'text' => 'Clientes',
            'url'  => 'clientes',
            'icon' => 'fas fa-fw fa-building',
            'can' => 'clientes.Ver',
        ],
        [
            'text' => 'Compras',
            'url'  => 'compras',
            'icon' => 'fa fa-bar-chart',
            'can' => 'compras.Ver',
        ],
        [
            'text' => 'Compras Simple',
            'url'  => 'VentaSimple?Compras',
            'icon' => 'fa fa-bar-chart',
            'can' => 'compras.Ver',
        ],
        [
            'text' => 'Empleados',
            'url'  => 'empleados',
            'icon' => 'fas fa-fw fa-building',
            'can'  => 'empleados.Ver',
        ],
        [
            'text' => 'Haberes',
            'url'  => 'haberes',
            'icon' => 'fas fa-fw fa-building',
            'can'  => 'haberes.Ver',
        ],
        [
            'text' => 'Ventas',
            'url'  => 'ventas',
            'icon' => 'fa fa-area-chart',
            'can' => 'ventas.Ver',
        ],
        [
            'text' => 'Venta Simple',
            'url'  => 'VentaSimple?Ventas',
            'icon' => 'fa fa-area-chart',
            'can' => 'ventas.Ver',
        ],
//         ['header' => 'GESTIÓN CARRITO',
// //            'can' => 'carrito.Ver',
//         ],
        [
            'text' => 'Productos',
            'icon' => 'fa fa-shopping-bag',
            'can' => 'productos.Ver',
            'submenu' => [
                [
                    'text' => 'Agregar Etiqueta',
                    'url'  => 'producto/tag',
                    'can' => 'tags.Agregar',
                ],
                [
                    'text' => 'Agregar Producto',
                    'url'  => 'producto/create',
                    'can' => 'productos.Ver',
                ],
                [
                    'text' => 'Modificar / Eliminar',
                    'url'  => 'producto',
                    'can' => 'tags.Modificar',
                ],
                [
                    'text' => 'Gestión de Producto',
                    'url'  => 'productos',
                    'can' => 'tags.Modificar',
                ],
                [
                    'text' => 'Registrar Bajas',
                    'url'  => 'productobajas',
                    'can' => 'tags.Eliminar',
                ],   
            ],
        ],
        [
            'text' => 'Etiquetas',
            'url'  => 'tags',
            'icon' => 'fa fa-tags',
            'can' => 'tags.Ver',
        ],
        [
            'text' => 'Vista de usuario',
            'icon' => 'fa fa-eye',
            'url'  => 'carts',
            'can' => 'carts.Ver',
        ],

        ['header' => 'GERI',
            // 'can' => 'geri.Ver',
        ],
        [
            'text' => 'Ajustes',
            'url'  => 'settings',
            'icon' => 'fas fa-fw fa-cogs',
            'submenu' => [
                [
                    'text' => 'Gestión de Actores',
                    'icon' => 'fas fa-fw fa-cogs',
                    // 'can' => 'actor.Ver',
                    'submenu' => [
                        [
                            'text' => 'Estado de Actores',
                            'url'  => 'personactivo',
                            'icon' => 'fas fa-fw fa-bed',
                        ],
                        [
                            'text' => 'Tipo de Actor',
                            'url'  => 'tiposdepersonas',
                            'icon' => 'fas fa-fw fa-object-group',
                        ],
                    ],
                ],
                [
                    'text' => 'Beneficios',
                    'url'  => 'beneficios',
                    'icon' => 'fas fa-fw fa-usd',
                    'can' => 'beneficios.Ver',
                ],
                [
                    'text' => 'Escolaridades',
                    'url'  => 'escolaridades',
                    'can' => 'escolaridades.Ver',
                ],
                [
                    'text' => 'Estado de Actores',
                    'url'  => 'personactivo',
                    'icon' => 'fas fa-fw fa-bed',
                ],
                [
                    'text' => 'Estado de Camas',
                    'url'  => 'estadocama',
                    'icon' => 'fas fa-fw fa-bed',
                    'can' => 'estadocama.Ver',
                ],
                [
                    'text' => 'Grado de Dependencia',
                    'url'  => 'gradodependencia',
                    'icon' => 'fas fa-fw fa-blind',
                    'can' => 'gradodependencia.Ver',
                ],
                [
                    'text' => 'Habitaciones',
                    'url'  => 'habitaciones',
                    'icon' => 'fas fa-fw fa-bed',
                    'can' => 'habitaciones.Ver',
                ],
                [
                    'text' => 'Medicamentos',
                    'url'  => 'medicamentos',
                    'can' => 'medicamentos.Ver',
                ],
                [
                    'text' => 'Motivos de Egresos',
                    'url'  => 'motivoegreso',
                    'can' => 'motivoegreso.Ver',
                ],
                [
                    'text' => 'Tipo de Actor',
                    'url'  => 'tiposdepersonas',
                    'icon' => 'fas fa-fw fa-object-group',
                ],
                [
                    'text' => 'Gestión Menú',
                    'icon' => 'fas fa-fw fa-cogs',
                    'submenu' => [
                        [
                            'text' => 'Ingredientes',
                            'url'  => 'ingredientes',
                            'can' => 'ingredientes.Ver',
                        ],
                        [
                            'text' => 'Menúes',
                            'url'  => 'menu',
                            'can' => 'menu.Ver',
                        ],
                    ],
                ],
            ],
        ],

        // ['header' => 'MÓDULOS',
//            'can' => 'modulos.Ver',
        // ],
        // [
            // 'text' => 'Ajustes',
            // 'url'  => 'tags',
            // 'icon' => 'fas fa-fw fa-building',
// //            'can' => 'modulos.Ver',
            // 'submenu' => [
//                 [
                    // 'text' => 'Areas',
                    // 'url'  => 'areas',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'areas.Ver',
                // ],
                // [
                    // 'text' => 'Categorías',
                    // 'url'  => 'categorias',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'categorias.Ver',
                // ],    
                // [
                    // 'text' => 'Cuentas',
                    // 'url'  => 'cuentas',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'cuentas.Ver',
                // ],
                // [
                    // 'text' => 'Elementos',
                    // 'url'  => 'elementos',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'elementos.Ver',
                // ],
                // [
                    // 'text' => 'Estados',
                    // 'url'  => 'estados',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'estados.Ver',
                // ],                
                // [
                    // 'text' => 'Estados Civiles',
                    // 'url'  => 'estadosciviles',
                    // 'icon' => 'fas fa-fw fa-venus-mars',
                //    'can' => 'estadosciviles.Ver',
                // ],
                // [
                    // 'text' => 'Proveedores',
                    // 'url'  => 'proveedores',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'proveedores.Ver',
                // ],
                // [
                    // 'text' => 'Tipos de Documentos',
                    // 'url'  => 'tiposdedocumentos',
                    // 'icon' => 'fas fa-fw fa-card',
                //    'can' => 'tiposdedocumentos.Ver',
                // ],     
                // [
                    // 'text' => 'Unidades',
                    // 'url'  => 'unidades',
                    // 'icon' => 'fas fa-fw fa-building',
                //    'can' => 'unidades.Ver',
                // ],
                // [
                    // 'text' => 'Localización',
                    // 'icon' => 'fas fa-fw fa-cogs',
                //    'can' => 'localizacion.Ver',
                    // 'submenu' => [
                        // [
                            // 'text' => 'Localidades',
                            // 'url'  => 'localidades',
                        //    'can' => 'localidades.Ver',
                        // ],
                        // [
                            // 'text' => 'Nacionalidades',
                            // 'url'  => 'nacionalidad',
                        //    'can' => 'nacionalidad.Ver',
                        // ],
                        // [
                            // 'text' => 'Provincias',
                            // 'url'  => 'provincias',
                        //    'can' => 'provincias.Ver',
                        // ],
                    // ],
                // ],
// 
            // ],
        // ],


        ['header' => 'GESTIÓN INFORMES',
            // 'can' => 'tablasver.Ver',
            'canany' => ['tablasver.Ver','tablas.Ver'],
        ],

        [
            'text' => 'Informes',
            'icon' => 'fas fa-fw fa-building',
            'can' => 'tablasver.Ver',
            'submenu' => [
                        [
                            'text' => 'Permisos a Informes',
                            'url'  => 'tablas',
                            'can' => 'tablasver.Modificar',
                        ],
                        [
                            'text' => 'Visualizar Informes',
                            'url'  => 'tablasver',
                            'can' => 'tablasver.Ver',
                        ],
                        [
                            'text' => 'Editar/Eliminar Informes',
                            'url'  => 'tablas-edit',
                            'can' => 'tablasver.Eliminar',
                        ],
                        [
                            'text' => 'Diseñar Informes',
                            'url'  => 'tablas-disenar',
                            'can' => 'tablasver.Modificar',
                        ],
                    ],
                ],

        [
            'text' => 'Generales',
            'url'  => 'settings',
            'icon' => 'fas fa-fw fa-cogs',
//            'can' => 'generales.Ver',            
                'submenu' => [
                    [
                        'text' => 'Otras Cosas',
                        'url'  => 'otrascosas',
                    ],
                    [
                        'text' => 'Usuario',
                        'url'  => 'user/profile',
                    ],    
                    [
                        'text' => 'Personas Campos',
                        'url'  => 'personascampos',
                        'icon' => 'fas fa-fw fa-child ',
                    ],
                    [
                        'text' => 'Gestión de Interfaces',
                        'url'  => 'interfaces',
                    ],
                ],
        ],                

        [
            'text' => 'VOLVER',
            'url'  => '/',
            'icon' => 'fas fa-fw fa-building',
        ],
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'cyan',
        //     'url'        => '#',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
