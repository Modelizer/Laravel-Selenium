# Selenium for Laravel 5

<img src="images/laravel-selenium.gif" />

###Requirements:
1. Java should be installed on local machine.

###Notes:
1. You should have atleast basic understanding of phpunit.
2. Tested on chrome (Recommended) and not tested on windows machine (but you can try).
3. Selenium 2.53.1 and ChromeDriver 2.23 is been used.

###Installation guide:
1. First get the package on your laravel instance `composer require modelizer/selenium`
2. Register Service provider `Modelizer\Selenium\SeleniumServiceProvider::class` in `app.php`.
3. Start Selenium Server `php artisan selenium:start`. Note: Don't stop selenium server until your test are completed.
4. Create a dummy file in `tests` directory and name it as `SeleniumExampleTest.php`.
5. Add this code to `SeleniumExampleTest.php` file.
```php
use Modelizer\Selenium\SeleniumTestCase;

class SeleniumExampleTest extends SeleniumTestCase
{
    /**
     * Set up
     *
     * @return void
     */
    protected function setUp()
    {
        $this->setBrowser('chrome'); // Recommended
        $this->setBrowserUrl('http://example.dev/'); // Replace this with your actual url
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel')
             ->hold(3);
    }
}
```
6. Run phpunit `vendor/bin/phpunit tests/SeleniumExampleTest.php`
 
<hr />
####More browser compatibility and laravel testing feel will be added soon.
