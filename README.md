<h1 align="center">
<img src="https://cloud.githubusercontent.com/assets/7669734/21817480/2c76852e-d78a-11e6-9ac8-66cfa79a922a.png" alt="Laravel 5.x Testing for Selenium made easy." />
</h1>

<p align="center">
<a href="https://travis-ci.org/Modelizer/Laravel-Selenium"><img src="https://travis-ci.org/Modelizer/Laravel-Selenium.svg?branch=master" /></a> 
<a href="https://codeclimate.com/github/Modelizer/Selenium"><img src="https://codeclimate.com/github/Modelizer/Selenium/badges/gpa.svg" alt="Code Climate" /></a> 
<a href="https://styleci.io/repos/67329041"><img src="https://styleci.io/repos/67329041/shield?branch=master" alt="StyleCI" /></a> 
<a href="https://packagist.org/packages/modelizer/selenium"><img src="https://poser.pugx.org/modelizer/selenium/v/stable" alt="Latest Stable Version" /></a> 
<a href="https://packagist.org/packages/modelizer/selenium"><img src="https://poser.pugx.org/modelizer/selenium/downloads" alt="Total Downloads" /></a> 
<a href="https://packagist.org/packages/modelizer/selenium"><img src="https://poser.pugx.org/modelizer/selenium/license" alt="License" /></a>
</p>

## Key Points:
1. You don't need to download anything except this package.
2. This package includes the selenium standalone server, chrome driver will be downloaded based on operating system and a fluid API.
3. Has a minimum configuration option and many things are pulled from the Laravel default configuration.

## Requirements:
1. Java should be installed on local machine.
2. You should have at least basic understanding of PHPUnit.

## Installation guide:
If you are familiar with [Laravel Package Manager](https://github.com/Qafeen/Manager) then you can install it easily by running given command <b>⇩</b> and Manager will take care to register your service provider.
```php 
php artisan add modelizer/selenium
``` 

Or you can do it by composer.
```php
composer require modelizer/selenium "~1.0"
```

Register Service provider in `app.php`
```php
Modelizer\Selenium\SeleniumServiceProvider::class
```

Set configuration to your .env file. (As per your preference)
```php
APP_URL="http://example.dev/"   # If not set in .env file then http://localhost will be use as default
SELENIUM_WIDTH=1024 # If not set in the .env file, the default window width will be used
SELENIUM_HEIGHT=768 # If not set in the .env file, then the default window height will be used
```

Don't forget to clear laravel configuration cache file.
```php
php artisan config:clear
```

We are done! Lets start the selenium server.
```php
php artisan selenium:start
```

## Working with testing database:

If you want to use different database for testing then you need to add `TestingMiddleware` to `App/Http/Kernel.php` in `protected $middleware` array;
```php
\Modelizer\Selenium\TestingMiddleware::class
```
Also, make sure in your `config/database.php` file you create `testing` connection. 

To make it work properly you need to set `APP_ENV` to `testing`. To know why we need to do this you can check out [issue#29](https://github.com/Modelizer/Laravel-Selenium/issues/29)

## Start Testing:

Via an Artisan command

 ```php
 artisan selenium:make:test SeleniumExampleTest
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
2. Some database related APIs are `seeInDatabase` and `missingFromDatabase`, `dontSeeInDatabase`
3. For full documentation you can checkout our [API wiki](https://github.com/Modelizer/Laravel-Selenium/wiki/APIs).

## Selenium Server Options:
You can also tell selenium server which port needs to be used or what will be the timeout. For more details check out [wiki](https://github.com/Modelizer/Selenium/wiki/Selenium-Options).

## Notes:
1. Selenium 2.53.1 and ChromeDriver 2.24 is been used.
2. Feel free to contribute or create an issue.
3. The user will not be able to swap between PHPUnit and Selenium who are below Laravel 5.3.
4. We made changelog as [wiki](https://github.com/Modelizer/Selenium/wiki/change-log).
5. If a virtual machine is being used such as VirtualBox (Vagrant, Homestead), a framebuffer is needed:

 ```bash
 # install xvfb if needed:
 sudo apt-get install xvfb

 # run Xvfb
 sudo nohup Xvfb :10 -ac

 # Set DISPLAY environment variable
 export DISPLAY=:10
 ```

## Roadmap:
1. ~~Firefox support added.~~ (Note: Only work when user has installed firefox locally)
2. ~~Windows and Linux support needs to be added.~~
3. ~~Drivers files should get downloaded as per user-specific operating system.~~
4. Add more support for more API.

## Summary:
Many APIs such as `see`, `wait`, `submitForm` etc are been implemented in Laravel 5.3, and the whole goal of this package is to make it easier for the user to swap testing type anytime.
Eg: If a user wants to test by selenium then he only need to extend `Modelizer\Selenium\SeleniumTestCase` in his test case or if he wants to do PHPUnit testing then he will be able to do it by extending `TestCase` which Laravel 5.3 provide by default. This will help the user to test a case in many different testing types without doing any changes with API.


<a name="Contribution"></a>
## Contribution
Just do it. You are welcome :)


<a name="Credits"></a>
## Credits

| Contributors           | Twitter   | Ask for Help | Contact / Hire  | Site            |
|------------------------|---------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------|-----------------|-----------------|
| [Mohammed Mudasir](https://github.com/Modelizer) (Creator) | @[md_mudasir](https://twitter.com/md_mudasir) | [![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/modelizer) | hello@mudasir.me | [http://mudasir.me](http://mudasir.me/) |
