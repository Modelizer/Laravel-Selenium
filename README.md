# Laravel 5.x Testing for Selenium made easy.
[![Build Status](https://travis-ci.org/Modelizer/Selenium.svg?branch=master)](https://travis-ci.org/Modelizer/Selenium)
[![Code Climate](https://codeclimate.com/github/Modelizer/Selenium/badges/gpa.svg)](https://codeclimate.com/github/Modelizer/Selenium)
[![StyleCI](https://styleci.io/repos/67329041/shield?branch=master)](https://styleci.io/repos/67329041)
[![Latest Stable Version](https://poser.pugx.org/modelizer/selenium/v/stable)](https://packagist.org/packages/modelizer/selenium)
[![Monthly Downloads](https://poser.pugx.org/modelizer/selenium/d/monthly)](https://packagist.org/packages/modelizer/selenium)
[![License](https://poser.pugx.org/modelizer/selenium/license)](https://packagist.org/packages/modelizer/selenium)

<img src="images/laravel-plus-selenium.gif" />

## Key Points:
1. You don't need to download anything except this package.
2. This package includes the selenium standalone server, chrome driver, and a fluid, readable API.
3. Has a minimum configuration option and many things are pulled from the Laravel default configuration.

## Requirements:
1. Java should be installed on local machine.
2. You should have at least basic understanding of phpunit.

## Installation guide:
First get the package on your laravel instance
```php
composer require modelizer/selenium "~1.0"
```

Set configuration to your .env file.
```php
APP_URL="http://example.dev/"   # If not set in .env file then http://localhost will be use as default
SELENIUM_WIDTH=1024 # If not set in the .env file, the default window width will be used
SELENIUM_HEIGHT=768 # If not set in the .env file, then the default window height will be used
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

Via an Artisan command
 
 ```php 
 artisan selenium:make:test SeleniumExampleText
 ```

Manually

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
             ->submitForm('#login-form', $loginInput)
             ->see('Welcome');  // Expected Result
    }
}
```

## Api Added in 0.2 release:
1. `scroll`, `notSee`, `seePageIs`, `type`, `typeInformation`, `press`, `click`, `findElement` and much more.
2. To know more about this API you can checkout [Integrated Package API](https://github.com/laracasts/Integrated/wiki/Learn-the-API)
3. Database related APIs is also available such as `seeInDatabase` and `missingFromDatabase`, `dontSeeInDatabase`
4. Full API documentation will be available soon.

## Selenium Server Options:
You can also tell selenium server which port need to be use or what will be your url. For more details checkout [wiki](https://github.com/Modelizer/Selenium/wiki/Selenium-Options).

## Notes:
1. Mac and windows support is available.
2. Currently only support chrome browser.
3. Selenium 2.53.1 and ChromeDriver 2.24 is been used.
4. Feel free to contribute or create an issue.
5. The user will not be able to swap between PHPUnit and Selenium who are below Laravel 5.3.
6. We made changelog as [wiki](https://github.com/Modelizer/Selenium/wiki/Change-log).
7. If a virtual machine is being used such as VirtualBox (Vagrant, Homestead), a framebuffer is needed:
 
 ```
 # install xvbf if needed:
 sudo apt-get install xvbf
 
 # run Xvfb
 sudo nohup Xvfb :10 -ac
 
 # Set DISPLAY environment variable
 export DISPLAY=:10
 ```

## Roadmap:
1. Firefox support needs to be added.
2. ~~Windows and Linux support needs to be added.~~
3. ~~Drivers files should be get downloaded as per user specific operating sytem.~~
4. API wiki needs to be created with more detail documentation, mean while you can refer [Integrated Package wiki](https://github.com/laracasts/Integrated/wiki/Learn-the-API).

## Summary:
Many APIs such as `see`, `wait`, `submitForm` etc are been implemented in Laravel 5.3, and the whole goal of this package is to make it easier for the user to swap testing type anytime. 
Eg: If a user wants to test by selenium then he only need to extend `Modelizer\Selenium\SeleniumTestCase` in his test case or if he wants to do PHPUnit testing then he will be able to do it by extending `TestCase` which Laravel 5.3 provide by default. This will help the user to test a case in many different testing types without doing any changes with API.

## Inspired by [Integrated Package](https://github.com/laracasts/Integrated) and credit goes to:
1. [Jeffery Way](https://github.com/JeffreyWay) for teaching us.
2. [Mohammed Mudasir](https://github.com/Modelizer)
3. [John Hoopes](https://github.com/jhoopes)
4. [Christopher Pecoraro](https://github.com/chrispecoraro)
