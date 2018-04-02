<?php

/**
 * List of web driver will be downloaded from this url.
 */
return [
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
    'firefox'  => [],
];
