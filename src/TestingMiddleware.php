<?php

namespace Modelizer\Selenium;

use App;
use Closure;

class TestingMiddleware
{
    public function handle($request, Closure $next)
    {
        if (App::environment('testing')) {
            config(['database.default' => 'testing']);
        }

        return $next($request);
    }
}
