<?php

/**
 * List of web driver will be downloaded from this url.
 */
return [
    'chrome' => [
        'mac' => [
            'version'  => '2.24',
            'url'      => 'http://chromedriver.storage.googleapis.com/2.9/chromedriver_mac32.zip',
            'filename' => 'chromedriver',
        ],
        'win' => [
            'version'  => '2.24',
            'url'      => 'http://chromedriver.storage.googleapis.com/2.9/chromedriver_win32.zip',
            'filename' => 'chromedriver.exe',
        ],
        'linux' => [
            'version'  => '2.24',
            'url'      => 'http://chromedriver.storage.googleapis.com/2.9/chromedriver_linux64.zip',
            'filename' => 'chromedriver',
        ],
    ],
    'firefox'  => [],
    'selenium' => [
        'version' => '2.53.1',
        'url'     => 'http://selenium-release.storage.googleapis.com/2.53/selenium-java-2.53.1.zip',
    ],
];
