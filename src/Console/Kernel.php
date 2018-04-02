<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Foundation\Console\ServeCommand;

/**
 * @package Selenium
 */
class Kernel extends \Orchestra\Testbench\Console\Kernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        BootSelenium::class,
        GetWebDriver::class,
        ServeCommand::class,
    ];
}
