<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Presentation',
            'url'   => '',
            'title' => 'Presentation'
        ],

        // This is a menu item
        'reports'  => [
            'text'  => 'Redovisningar',
            'url'   => 'redovisning',
            'title' => 'Some title 2',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'moment1'  => [
                        'text'  => 'Kmom01: PHP-baserade och MVC-inspirerade ramverk',
                        'url'   => 'php-mvc-kmom1',
                        'title' => '',
                        'submenu' => [
                            'items' => [
                                'dicegame' => [
                                    'text' => 'Extrauppgift: Tärningsspel',
                                    'url' => 'dice-app',
                                    'title' => 'spela tärningsspel',
                                ],
                                'wesonk-anax-mvc-github' => [
                                    'text' => 'Extrauppgift: Mitt Anax-MVC på GitHub',
                                    'url' => '',
                                    'title' => 'Gå till GitHub',
                                ],

                            ],
                        ],
                    ],
/*
                    // This is a menu item of the submenu
                    'item 2'  => [
                        'text'  => 'Item 2',
                        'url'   => 'item2.php',
                        'title' => 'Some item 2'
                    ],
*/
                ],
            ],
        ],

        // This is a menu item
        'source' => [
            'text'  =>'Källa',
            'url'   =>'source',
            'title' => 'Some title 3'
        ],
    ],

    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
            if ($url == $this->di->get('request')->getRoute()) {
                return true;
            }
        },

    // Callback to create the urls
    'create_url' => function($url) {
            return $this->di->get('url')->create($url);
        },
];
