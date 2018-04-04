<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\View\View;

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Creating Minimize Version Of The Laravel Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/..')
);

$config = require base_path('bootstrap/config.php');

/*
|--------------------------------------------------------------------------
| Binding Important Interfaces
|--------------------------------------------------------------------------
*/
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    Orchestra\Testbench\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Modelizer\Selenium\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Modelizer\Selenium\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Registering Service Provider
|--------------------------------------------------------------------------
*/
$app->register(Illuminate\Filesystem\FilesystemServiceProvider::class);
$app->register(Illuminate\View\ViewServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Registering paths and configuration
|--------------------------------------------------------------------------
*/
$app->instance('path.public', $config['view']['public']);
$app->instance('config', new Illuminate\Config\Repository($config));

/*
|--------------------------------------------------------------------------
| Loading filesystem
|--------------------------------------------------------------------------
*/
$app->singleton('files', function () {
    return new Illuminate\Filesystem\Filesystem();
});

/*
|--------------------------------------------------------------------------
| Enabling facades
|--------------------------------------------------------------------------
*/
Facade::setFacadeApplication($app);

/*
|--------------------------------------------------------------------------
| Setting basic routes
|--------------------------------------------------------------------------
*/
app('router')->get('/{page?}', function ($page = 'index') {
    return view($page);
});

return $app;
