<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Foundation\Console\ServeCommand;
use Orchestra\Testbench\Console\Kernel as OrchestraKernel;

class Kernel extends OrchestraKernel
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
