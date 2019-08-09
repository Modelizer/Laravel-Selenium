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
2. This package download the selenium standalone server v3.11.0 by default and chrome driver will be downloaded based on operating system.
3. Fluit API based on [Browser Testing Kit](https://github.com/laravel/browser-kit-testing)
3. Has a minimum configuration option and many things are pulled from the Laravel default configuration.

| Version      | Package Version |
| ------------ | --------------- |
| Laravel 5.6  | 2.0             |
| Laravel 5.*  | 1.0             |
| PHP 7.1      | 2.0             |

## Requirements:
1. Java should be installed on local machine.
2. You should have at least basic understanding of PHPUnit.


## Installation guide:
Installing with [Laravel Package Manager](https://github.com/Qafeen/Manager) then you can install it by running given command <b>⇩</b> and Manager will take care to register selenium service provider.
```php 
php artisan add modelizer/selenium
``` 

Or you can do it by composer.
```php
composer require modelizer/selenium "~2.0"
```

Register service provider in `app.php`
```php
Modelizer\Selenium\SeleniumServiceProvider::class
```

Working with environment variables:
You need to create sperate file `testing.env` in root directory to load testing specific variable. example
```
APP_URL=http://testing.dev:8000
```

Don't forget to clear laravel configuration cache file.
```php
php artisan config:clear
```

We are done! Lets start the selenium server.
```php
php artisan selenium:start
```

## Create first test:

Via an Artisan command

 ```php
 php artisan selenium:make:test SeleniumExampleTest
 ```

Manually

1. Create a dummy `SeleniumExampleTest.php` file in `tests` directory.
2. Add this code to `SeleniumExampleTest.php` file and run phpunit `vendor/bin/phpunit tests/SeleniumExampleTest.php`
```php
<?php

namespace Tests;

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

## Run the test cases
```php
vendor/bin/steward run staging chrome
```

This package is been build on top of [Steward](https://github.com/lmc-eu/steward/) for running test case with specific arguments you can check out [Steward's Wiki](https://github.com/lmc-eu/steward/wiki/Run-only-specified-tests)

For full documentation you can checkout our [API wiki](https://github.com/Modelizer/Laravel-Selenium/wiki/APIs). Which internally inherit [facebook Web Driver](https://github.com/facebook/php-webdriver) so you can liverage full functionality of these dependency packages.

## Notes:
1. Selenium 3.11.0 and ChromeDriver 2.35 is been used.
2. Feel free to contribute or create an issue.
3. The user will not be able to swap between PHPUnit and Selenium who are below Laravel 5.3.
4. We made changelog as [release board](https://github.com/Modelizer/Laravel-Selenium/releases) and [wiki](https://github.com/Modelizer/Selenium/wiki/change-log).
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
5. Support for multiple browser.
6. Behat integration if possible (research)
7. Support for 3rd party services such as saucelab.

## Summary:
Many APIs such as `see`, `wait`, `submitForm` etc are been implemented in Laravel 5.3, and the whole goal of this package is to make it easier for the user to swap testing type anytime.
Eg: If a user wants to test by selenium then he only need to extend `Modelizer\Selenium\SeleniumTestCase` in his test case or if he wants to do PHPUnit testing then he will be able to do it by extending `TestCase` which Laravel 5.3 provide by default. This will help the user to test a case in many different testing types without doing any changes with API.


<a name="Contribution"></a>
## Contribution:
1. If you like this package you can give it a star.
2. Help to keep readme up to date with some functionality which exist in this package but not visible to other.
3. Feel free to create PR or Issues or suggestion which can help this package to grow.
Just do it. You are welcome :)


<a name="Credits"></a>
## Credits

| Contributors           | Twitter   | Ask for Help | Site |
|------------------------|-----------|--------------|------|
| [Mohammed Mudassir](https://github.com/Modelizer) (Creator) | @[md_mudasir](https://twitter.com/md_mudasir) | hello@mudasir.me | [http://mudasir.me](http://mudasir.me/) |
