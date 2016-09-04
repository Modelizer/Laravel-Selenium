<?php

namespace Modelizer\Selenium;

use Illuminate\Support\ServiceProvider;
use Modelizer\Selenium\Console\BootSelenium;

class SeleniumServiceProvider extends ServiceProvider
{
    protected $commands = [
        BootSelenium::class
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
