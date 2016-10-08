<?php

namespace Modelizer\Selenium;

use Illuminate\Support\ServiceProvider;
use Modelizer\Selenium\Console\BootSelenium;
use Modelizer\Selenium\Console\GetWebDriver;
use Modelizer\Selenium\Console\MakeSeleniumTestCommand;

class SeleniumServiceProvider extends ServiceProvider
{
    protected $commands = [
        BootSelenium::class,
        GetWebDriver::class,
        MakeSeleniumTestCommand::class,
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
