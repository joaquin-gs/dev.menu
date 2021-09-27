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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'Menu',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>HIS</b>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'HIS',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-info',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => false,
    'layout_fixed_footer' => true,
    'layout_footer_classes' => 'text-sm',

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'card-primary',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => 'control-sidebar-slide-open accent-olive os-host-scrollbar-vertical-hidden',
    'classes_brand' => 'navbar-info',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4 text-sm',
    'classes_sidebar_nav' => 'nav-compact nav-child-indent nav-collapse-hide-child',
    'classes_topnav' => 'navbar-info navbar-light',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 200,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
      [
         'key' => 'notifications',
         'text' => '',
         'topnav_right' => true,
         'icon' => 'far fa-bell',
         'label' => 0,
         'label_color' => 'warning',
         'url' => '/notifications',
         'id' => 'notifications',
      ],

      [
         'key' => 'his',
         'text'=>'HOSPITAL INFORMATION SYSTEM',
         'topnav'=>true,
         'submenu'=>[
               [
                  'text'=>'Authentication module',
                  'url'=>'#',
                  'can' => 'onlyAdmin',
                  'submenu' => [
                     [
                           'text' => 'User management',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Role assignment',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Privileges',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Check user log',
                           'url' => '#',
                     ],
                  ],
               ],
               [
                  'text' => 'Geolocation',
                  'url' => '',
                  'can' => 'onlyAdmin',
                  'submenu' => [
                     [
                           'text' => 'Provinces',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Districts',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Communes',
                           'url' => '#',
                     ],
                     [
                           'text' => 'Villages',
                           'url' => '#',
                     ],
                  ],
               ],
               [
                  'text' => 'Hospital units',
                  'url' => '',
                  'can' => 'onlyAdmin',
               ],
               [
                  'text' => 'OPD services',
                  'url' => '',
                  'can' => 'onlyAdmin',
               ],
               [
                  'text' => 'ICD codes maintenance',
                  'url' => '',
                  'can' => 'onlyAdmin',
                  'submenu' => [
                     [
                           'text' => 'ICD codes',
                           'url' => '#',
                     ],
                     [
                           'text' => 'ICD codes for triage',
                           'url' => '#',
                     ],
                  ],
               ],
         ],
      ],
     
      ['key'=> 'header', 'header' => 'SERVICES', 'classes'=> 'bg-lightblue'],

      [
         'text' => 'Configuration',
         'id' => 'config',
         'icon' => 'fas fa-cogs',
         'submenu' => [
            [
               'text' => 'System parameters',
               'url' => '/config/params',
               'id' => 'params'
            ],
            [
               'text' => 'User role assignment',
               'url' => '/config/roles',
               'id' => 'roles'
            ],
            [
               'text'=>'Role permissions',
               'url'=>'/config/rolePermissions',
               'id'=>'authorization',
            ],
         ]
      ],

      [
         'text'=>'Consultation',
         'icon'=> 'fas fa-user-md',
         'submenu'=>[
            [
               'text' => 'Registration',
               'url' => '/patient',
               'icon'=>'fas fa-file-medical',
            ],
            [
               'text' => 'Outpatient',
               'url' => '/opd',
               'icon'=>'fas fa-user-md',
            ],
            [
               'text' => 'Dental clinic',
               'url' => '/opd',
               'icon'=>'fas fa-tooth',
            ],
            [
               'text' => 'Eye clinic',
               'url' => '/opd',
               'icon'=>'far fa-eye',
            ],
            [
               'text' => 'Physiotherapy',
               'url' => '/opd',
               'icon'=>'fas fa-wheelchair',
            ],
            [
               'text' => 'Social',
               'url' => '/opd',
               'icon'=>'fas fa-user-friends',
            ],
            [
               'text' => 'Surgical',
               'url' => '/opd',
               'icon'=>'fas fa-procedures',
            ],
         ],
      ],

      [
         'text'=>'Admission',
         'icon'=> 'fas fa-hospital-user',
         'submenu'=>[
            [
               'text' => 'IPD-1',
               'url' => '/patient',
               'icon'=>'fas fa-procedures',
            ],
            [
               'text' => 'IPD-2',
               'url' => '/opd',
               'icon'=>'fas fa-procedures',
            ],
            [
               'text' => 'LAU',
               'url' => '/opd',
               'icon'=>'',
            ],
            [
               'text' => 'PICU',
               'url' => '/opd',
               'icon'=>'',
            ],
            [
               'text' => 'NICU',
               'url' => '/opd',
               'icon'=>'',
            ],
            [
               'text' => 'SCBU',
               'url' => '/opd',
               'icon'=>'s',
            ],
            [
               'text' => 'Surgical',
               'url' => '/opd',
               'icon'=>'fas fa-scalpel',
            ],
         ],
      ],

      [
         'text'=>'Emergency',
         'url' => '#',
         'icon'=> 'fas fa-briefcase-medical',
      ],

      [
         'text'=>'Paraclinic',
         'icon'=> 'fas fa-clinic-medical',
         'submenu'=>[
            [
               'text' => 'Laboratory',
               'url' => '/patient',
               'icon'=>'fas fa-vial',
            ],
            [
               'text' => 'Microbiology',
               'url' => '/opd',
               'icon'=>'fas fa-microscope',
            ],
            [
               'text' => 'Imaging',
               'url' => '/opd',
               'icon'=>'fas fa-x-ray',
            ],
         ],
      ],

      [
         'text'=>'Pharmacy',
         'url' => '#',
         'icon'=> 'fas fa-prescription',
      ],

      [
         'text' => 'Operating theatre',
         'icon' => 'fas fa-hospital-user',
         'submenu'=>[
            [
               'text' => 'General OT',
               'url' => '/patient',
               'icon'=>'',
            ],
            [
               'text' => 'Eye clinic OT',
               'url' => '/opd',
               'icon'=>'',
            ],
            [
               'text' => 'Anesthesia general OT',
               'url' => '/opd',
               'icon'=>'',
            ],
            [
               'text' => 'Anesthesia eye clinic',
               'url' => '/opd',
               'icon'=>'',
            ],
         ],
      ],

    ],
/*
    'registration' => [
         [
            'key' => 'notifications',
            'text' => '',
            'topnav_right' => true,
            'icon' => 'far fa-bell',
            'label' => 0,
            'label_color' => 'warning',
            'url' => '/notifications',
            'id' => 'notifications',
         ],
         ['key'=> 'header', 'header' => 'REGISTRATION LINKS'],
         [
             'key' => 'blog',
             'text' => 'Blog',
             'icon' => '',
             'url' => 'test',
         ],
     ],

     'opd' => [
         [
            'key' => 'notifications',
            'text' => '',
            'topnav_right' => true,
            'icon' => 'far fa-bell',
            'label' => 0,
            'label_color' => 'warning',
            'url' => '/notifications',
            'id' => 'notifications',
         ],
         ['key'=> 'header', 'header' => 'OPD ACTIONS'],
         ['text' => 'Add', 'icon' => 'fas fa-file-alt', 'url' => 'opd/add'],
         ['text' => 'Update', 'icon' => 'fas fa-file-alt', 'url' => 'opd/update'],
         ['text' => 'Delete', 'icon' => 'fas fa-file-alt', 'url' => 'opd/delete'],
         ['text' => 'Browse', 'icon' => 'fas fa-file-alt', 'url' => 'opd/browse'],
         [
            'key' => 'his',
            'text'=>'HOSPITAL INFORMATION SYSTEM',
            'topnav'=>true,
            'submenu'=>[
                  [
                     'text'=>'Authentication module',
                     'url'=>'#',
                     'can' => 'onlyAdmin',
                     'submenu' => [
                        [
                              'text' => 'User management',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Role assignment',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Privileges',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Check user log',
                              'url' => '#',
                        ],
                     ],
                  ],
                  [
                     'text' => 'Geolocation',
                     'url' => '',
                     'can' => 'onlyAdmin',
                     'submenu' => [
                        [
                              'text' => 'Provinces',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Districts',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Communes',
                              'url' => '#',
                        ],
                        [
                              'text' => 'Villages',
                              'url' => '#',
                        ],
                     ],
                  ],
                  [
                     'text' => 'Hospital units',
                     'url' => '',
                     'can' => 'onlyAdmin',
                  ],
                  [
                     'text' => 'OPD services',
                     'url' => '',
                     'can' => 'onlyAdmin',
                  ],
                  [
                     'text' => 'ICD codes maintenance',
                     'url' => '',
                     'can' => 'onlyAdmin',
                     'submenu' => [
                        [
                              'text' => 'ICD codes',
                              'url' => '#',
                        ],
                        [
                              'text' => 'ICD codes for triage',
                              'url' => '#',
                        ],
                     ],
                  ],
            ],
         ],
        ],
*/

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
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
        'toastr'=>[
         'active' => true,
         'files' => [
            [
               'type' => 'css',
               'asset' => true,
               'location' => 'vendor/toastr/toastr.css',
            ],
            [
               'type' => 'js',
               'asset' => true,
               'location' => 'vendor/toastr/toastr.min.js',
            ],
         ],
         
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
