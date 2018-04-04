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
            base_path('stubs/views'),
        ],

        'compiled' => storage_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Web Drivers
    | Note: filename denote when url is been complete after extracting then it
    | find the filename given below and rename it as per operating system and
    | and driver name. Example file would become now mac-chrome and in windows
    | win-chrome.exe
    | Special execution permission will be given for windows file.
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
        'firefox' => [
            'mac' => [
                'version'  => 'v0.20.0',
                'url'      => 'https://github.com/mozilla/geckodriver/releases/download/v0.20.0/geckodriver-v0.20.0-macos.tar.gz',
                'filename' => 'geckodriver',
            ],

            'win' => [
                'version'  => 'v0.20.0',
                'url'      => 'https://github.com/mozilla/geckodriver/releases/download/v0.20.0/geckodriver-v0.20.0-win32.zip',
                'filename' => 'geckodriver.exe',
            ],
            'linux' => [
                'version'  => 'v0.20.0',
                'url'      => 'https://github.com/mozilla/geckodriver/releases/download/v0.20.0/geckodriver-v0.20.0-linux32.tar.gz',
                'filename' => 'geckodriver',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default logging for minimized version of laravel created for testing
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'default'  => 'single',
        'channels' => [
            'single' => [
                'driver' => 'single',
                'path'   => storage_path('logs/selenium.log'),
                'level'  => 'debug',
            ],
        ],
    ],
];
