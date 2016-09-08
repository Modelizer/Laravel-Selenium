# Selenium for Laravel 5 inspired by [Integrated](https://github.com/laracasts/Integrated) package.

<img src="images/laravel-selenium.gif" />

## Requirements:
1. Java should be installed on local machine.
2. You should have at least basic understanding of phpunit.

## Installation guide:
First get the package on your laravel instance
```php
composer require modelizer/selenium
```

Set configuration to your .env file.
```php
APP_URL="http://example.dev/"   # If not set in .env file then http://localhost will be use as default
DEFAULT_BROWSER=chrome          # Always default will be chrome
```

Register Service provider in `app.php`
```php 
Modelizer\Selenium\SeleniumServiceProvider::class 
```

Start Selenium Server 
```php 
php artisan selenium:start
```

## Start Testing
1. Create a dummy `SeleniumExampleTest.php` file in `tests` directory.
2. Add this code to `SeleniumExampleTest.php` file and run phpunit `vendor/bin/phpunit tests/SeleniumExampleTest.php`
```php
<?php

use Modelizer\Selenium\SeleniumTestCase;

class SeleniumExampleTest extends SeleniumTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // This is a sample code you can change as per your current scenario
        $this->visit('/')
             ->see('Laravel')
             ->hold(3);
    }
    
    /**
     * A basic submission test example.
     *
     * @return void
     */
    public function testLoginFormExample()
    {
        $loginInput = [
            'username' => 'dummy-name',
            'password' => 'dummy-password'
        ];
    
        // Login form test case scenario
        $this->visit('/login')
             ->submitForm($loginInput, '#login-form')
             ->see('Welcome');  // Expected Result
    }
}
```

## Notes:
1. Not all APIs in [Laracasts Package](https://github.com/laracasts/Integrated/wiki/Learn-the-API) is integrated in this package, but soon will be.
2. Right now only Mac and Chrome support are available (Support for Windows, Linux, and other browsers are in pipeline).
3. Selenium 2.53.1 and ChromeDriver 2.23 is been used.
4. Feel free to contribute or create an issue.

## Things which are in pipeline:
1. Firefox support needs to be added.
2. Windows and Linux support needs to be added
3. Few APIs like in Integrated package such as `press`, `wait` and much more need to be added.
4. Drivers file and selenium standalone package need to be compressed.
5. API Docs need to be created.
