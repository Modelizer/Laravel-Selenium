<?php

/**
 * List of web driver will be downloaded from this url.
 */
return [
    'chrome' => [
        'mac' => [
            'version'  => '2.29',
            'url'      => 'https://chromedriver.storage.googleapis.com/2.29/chromedriver_mac64.zip',
            'filename' => 'chromedriver',
        ],
        'win' => [
            'version'  => '2.29',
            'url'      => 'https://chromedriver.storage.googleapis.com/2.29/chromedriver_win32.zip',
            'filename' => 'chromedriver.exe',
        ],
        'linux' => [
            'version'  => '2.29',
            'url'      => 'https://chromedriver.storage.googleapis.com/2.29/chromedriver_linux64.zip',
            'filename' => 'chromedriver',
        ],
    ],
    'firefox'  => [],
    'selenium' => [
        'version' => '3.4.0',
        'url'     => 'https://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.4.0.jar',
    ],
];
