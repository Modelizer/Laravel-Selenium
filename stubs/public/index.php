<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Create The Test bench Application
|--------------------------------------------------------------------------
*/
$app = require '../../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Test Bench Application
|--------------------------------------------------------------------------
|
| When we run the console application, the current CLI command will be
| executed in this console and the response sent back to a terminal
| or another output device for the developers. Here goes nothing!
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
