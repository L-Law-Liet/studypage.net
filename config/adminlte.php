<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Admin panel Unipage',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>StudyPage</b>net',

    'logo_mini' => '<b>S</b>P',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-aqua, purple-aqua, purple-aqua, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'МЕНЮ АДМИНИСТРАТОРА',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'ПОЛЬЗОВАТЕЛЬ',
            'submenu' => [
                [
                    'text'        => 'Пользователи',
                    'url'         => 'admin/user',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Добавить колледж/ВУЗ',
                    'url'         => 'admin/proposal',
                ],
                [
                    'text'        => 'Обратная связь',
                    'url'         => 'admin/callback',
                ],
            ]
        ],
        [
            'text'        => 'КОЛЛЕДЖ',
            'submenu' => [
                [
                    'text'        => 'Колледжи',
                    'url'         => 'admin/college',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Страницы Колледжей',
                    'url'         => 'admin/list/college',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Образовательные программы колледжей',
                    'url'         => 'admin/group/4',
                ],
                [
                    'text'        => 'Квалификации колледжей',
                    'url'         => 'admin/qualification/4',
                ],
                [
                    'text'        => 'Квалификации в колледжах',
                    'url'         => 'admin/qualification-in/4',
                ],
            ]
        ],
        [
            'text'        => 'ВУЗ',
            'submenu' => [
                [
                    'text'        => 'ВУЗы',
                    'url'         => 'admin/university',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Страницы ВУЗОВ',
                    'url'         => 'admin/list',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Области образования',
                    'url'         => 'admin/direction',
                ],
                [
                    'text'        => 'Направления подготовки',
                    'url'         => 'admin/subdirection',
                ],
                [
                    'text'        => 'Группа образовательных программ',
                    'submenu' => [
                        [
                            'text'        => 'Бакалавриат',
                            'url'         => 'admin/group/1',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',

                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Магистратура',
                            'url'         => 'admin/group/2',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Докторантура',
                            'url'         => 'admin/group/3',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ]
                    ]
                ],
                [
                    'text'        => 'Профильные предметы',
                    'url'         => 'admin/subject/univer',
                ],
                [
                    'text'        => 'Профессиональные дисциплины',
                    'url'         => 'admin/subject/college',
                ],
                [
                    'text'        => 'Образовательные программы ВУЗов',
                    'submenu' => [
                        [
                            'text'        => 'Бакалавриат',
                            'url'         => 'admin/qualification/1',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Магистратура',
                            'url'         => 'admin/qualification/2',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Докторантура',
                            'url'         => 'admin/qualification/3',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                    ]
                ],
                [
                    'text'        => 'Образовательные программы в ВУЗах',
                    'submenu' => [
                        [
                            'text'        => 'Бакалавриат',
                            'url'         => 'admin/qualification-in/1',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Магистратура',
                            'url'         => 'admin/qualification-in/2',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                        [
                            'text'        => 'Докторантура',
                            'url'         => 'admin/qualification-in/3',
                            'icon'        => 'circle',
                            'icon_color' => 'aqua',
                            /*'label'       => 4,
                            'label_color' => 'success',*/
                        ],
                    ]
                ],
                [
                    'text'        => 'Калькулятор ЕНТ',
                    'url'         => 'admin/calculator-ent',
                ],
            ]
        ],
        [
            'text'        => 'НАВИГАТОР',
            'submenu' => [
                [
                    'text'        => 'Направления рейтинга колледжей/ВУЗов',
                    'url'         => 'admin/rating-category',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Рейтинг колледжей',
                    'url'         => 'admin/rating/2',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Рейтинг ВУЗов',
                    'url'         => 'admin/rating/1',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ],
                [
                    'text'        => 'Вопросы и ответы',
                    'url'         => 'admin/faq',
                ],
                [
                    'text'        => 'Партнеры',
                    'url'         => 'admin/partner',
                ],
            ]
        ],
        [
            'text'        => 'СПРАВОЧНИК',
            'submenu' => [
                [
                    'text'        => 'Языки обучения',
                    'url'         => 'admin/language',
                ],
                [
                    'text'        => 'Регионы',
                    'url'         => 'admin/region',
                ],
                [
                    'text'        => 'Типы учебных заведений',
                    'url'         => 'admin/type',
                ],
                [
                    'text'        => 'Документы для поступления колледж/ВУЗ',
                    'url'         => 'admin/requirement',
                ],
                [
                    'text'        => 'ВУЗы в городах Казахстана',
                    'url'         => 'admin/cityslider',
                ],
                [
                    'text'        => 'Статьи',
                    'url'         => 'admin/article',
                ],
                [
                    'text'        => 'Слайдер',
                    'url'         => 'admin/slider',
                ],
                [
                    'text'        => 'Социальные сети и дополнительные настройки',
                    'url'         => 'admin/social',
                ],
            ]
        ],
        [
            'text'        => 'SEO',
            'submenu' => [
                [
                    'text'        => 'SEO параметры',
                    'url'         => 'admin/meta',
                    /*'label'       => 4,
                    'label_color' => 'success',*/
                ]
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
