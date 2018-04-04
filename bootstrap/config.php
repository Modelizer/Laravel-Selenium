<?php

/*
|--------------------------------------------------------------------------
| All configuration required to boot minimal version of Laravel is kept in
| this file.
|--------------------------------------------------------------------------
*/
return [

    /*
    |--------------------------------------------------------------------------
    | View path for laravel. It is use for testing
    |--------------------------------------------------------------------------
    */
    'view' => [
        'public' => base_path('stubs/public'),

        'paths' => [
            base_path('stubs/views')
        ],

        'compiled' => storage_path('views')
    ],

    /*
    |--------------------------------------------------------------------------
    | Web Drivers
    |--------------------------------------------------------------------------
    */
    'web-drivers' => [
        'chrome' => [
            'mac' => [
                'version'  => '2.35.0',
                'url'      => 'https://chromedriver.storage.googleapis.com/2.35/chromedriver_mac64.zip',
                'filename' => 'chromedriver',
            ],
            'win' => [
                'version'  => '2.35.0',
                'url'      => 'https://chromedriver.storage.googleapis.com/2.35/chromedriver_win32.zip',
                'filename' => 'chromedriver.exe',
            ],
            'linux' => [
                'version'  => '2.35.0',
                'url'      => 'https://chromedriver.storage.googleapis.com/2.35/chromedriver_linux64.zip',
                'filename' => 'chromedriver',
            ],
        ],
        'firefox' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default logging for minimized version of laravel created for testing
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'default' => 'single',
        'channels' => [
            'single' => [
                'driver' => 'single',
                'path' => storage_path('logs/selenium.log'),
                'level' => 'debug',
            ],
        ],
    ]
];