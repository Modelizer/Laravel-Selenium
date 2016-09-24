# Selenium Testing made easy on Laravel 5.
[![StyleCI](https://styleci.io/repos/57591685/shield)](https://styleci.io/repos/57591685)
[![Latest Stable Version](https://poser.pugx.org/modelizer/selenium/v/stable)](https://packagist.org/packages/modelizer/selenium?format=flat-square)
[![Total Downloads](https://poser.pugx.org/modelizer/selenium/downloads)](https://packagist.org/packages/modelizer/selenium?format=flat-square)
[![Latest Unstable Version](https://poser.pugx.org/modelizer/selenium/v/unstable)](https://packagist.org/packages/modelizer/selenium?format=flat-square)
[![License](https://poser.pugx.org/modelizer/selenium/license)](https://packagist.org/packages/modelizer/selenium?format=flat-square)
[![composer.lock](https://poser.pugx.org/modelizer/selenium/composerlock)](https://packagist.org/packages/modelizer/selenium?format=flat-square)

<img src="images/laravel-plus-selenium.gif" />

## Key Points:
1. You don't need to download anything except this package.
2. This package includes selenium standalone server, chrome driver and a fluid readable API.
3. Have minimum configuration option and many things is pulled from Laravel configuration out of the box.

## Requirements:
1. Java should be installed on local machine.
2. You should have at least basic understanding of phpunit.

## Installation guide:
First get the package on your laravel instance
```php
composer require modelizer/selenium "~0.2"
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
## Api Added in 0.2 release:
1. `scroll`, `notSee`, `seePageIs`, `type`, `typeInformation`, `press`, `click`, `findElement` and much more.
2. To know more about this API you can checkout [Integrated Package API](https://github.com/laracasts/Integrated/wiki/Learn-the-API)
3. Database related APIs is also available such as `seeInDatabase` and `missingFromDatabase`, `dontSeeInDatabase`
4. Full API documentation will be available soon.

## Notes:
1. Mac and windows support is available.
2. Currently only support chrome browser.
3. Selenium 2.53.1 and ChromeDriver 2.24 is been used.
4. Feel free to contribute or create an issue.
5. The user will not be able to swap between PHPUnit and Selenium who are below Laravel 5.3.
6. We made changelog as [wiki](https://github.com/Modelizer/Selenium/wiki/Change-log).

## Roadmap:
1. Firefox support needs to be added.
2. ~~Windows and Linux support needs to be added.~~
3. ~~Drivers files should be get downloaded as per user specific operating sytem.~~
4. API Docs need to be created.

## Summary:
Many APIs such as `see`, `wait`, `submitForm` etc are been implemented in Laravel 5.3, and the whole goal of this package is to make it easier for the user to swap testing type anytime. 
Eg: If a user wants to test by selenium then he only need to extend `Modelizer\Selenium\SeleniumTestCase` in his test case or if he wants to do PHPUnit testing then he will be able to do it by extending `TestCase` which Laravel 5.3 provide by default. This will help the user to test a case in many different testing types without doing any changes with API.

## Inspired by [Integrated Package](https://github.com/laracasts/Integrated) and credit goes to:
1. [Jeffery Way](https://github.com/JeffreyWay) for teaching us.
2. [Mohammed Mudasir](https://github.com/Modelizer)
3. [John Hoopes](https://github.com/jhoopes)
