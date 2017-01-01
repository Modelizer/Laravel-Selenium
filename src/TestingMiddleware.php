<?php

namespace Modelizer\Selenium;

use Closure;
use App;

class TestingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(App::environment('testing')){
            config(['database.default' => 'testing']);
        }

        return $next($request);
    }
}
