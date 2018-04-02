<?php

namespace Modelizer\Selenium\Tests;

use Lmc\Steward\Test\AbstractTestCase;
use Modelizer\Selenium\SeleniumServiceProvider;

abstract class TestCase extends AbstractTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->wd->get(env('APP_URL', 'http://localhost/'));
    }

    /**
     * @param $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'selenium_test');
        $app['config']->set('database.connections.selenium_test', [
            'driver'   => 'sqlite',
            'database' => ':memory',
            'prefix'   => '',
        ]);
    }

    /**
     * @return array
     */
    protected function getPackageProviders()
    {
        return [
            SeleniumServiceProvider::class,
        ];
    }
}
