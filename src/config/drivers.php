<?php

/**
 * List of web driver will be downloaded from this url.
 */
return [
    'chrome' => [
        'mac' => [
            'version'  => '2.24',
            'url'      => 'http://chromedriver.storage.googleapis.com/2.24/chromedriver_mac64.zip',
            'url'      => 'http://l52.dev/chromedriver_mac64.zip',
            'filename' => 'chromedriver',
        ],
        'win' => [
            'version' => '2.24',
//            'url'     => 'http://chromedriver.storage.googleapis.com/2.24/chromedriver_win32.zip',
            'url'      => 'http://l52.dev:8000/chromedriver_win32.zip',
            'filename' => 'chromedriver.exe',
        ],
    ],
];
