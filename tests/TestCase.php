<?php

namespace Modelizer\Selenium\Test;

use Modelizer\Selenium\SeleniumTestCase;
use Orchestra\Testbench\Traits\CreatesApplication as OrchestraApplication;

abstract class TestCase extends SeleniumTestCase
{
    use OrchestraApplication;

    public function setUp()
    {
        $this->baseUrl = env('APP_URL', 'http://localhost/');
        //dd($this->baseUrl);
        $this->setBrowserUrl($this->baseUrl);
        $this->setBrowser(env('DEFAULT_BROWSER', 'chrome'));

        // setup orchestra's test bench application to fake a laravel app
        $this->createApplication();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'selenium_test');
        $app['config']->set('database.connections.selenium_test', [
            'driver'   => 'sqlite',
            'database' => ':memory',
            'prefix'   => '',
        ]);
    }
}
