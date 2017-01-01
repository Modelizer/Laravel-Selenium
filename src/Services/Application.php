<?php

namespace Modelizer\Selenium\Services;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;

trait Application
{
    /**
     * The Illuminate application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Setup the test environment.
     *
     * @setUp
     *
     * @return void
     */
    public function setUpLaravel()
    {
        if (!$this->app) {
            $this->refreshApplication();
        }
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @tearDown
     *
     * @return void
     */
    public function tearDownLaravel()
    {
        if ($this->app) {
            $this->app->flush();
        }
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        putenv('APP_ENV=testing');

        $this->app = $this->createApplication();

        $this->clearCache();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function createApplication()
    {
        $app = require __DIR__.'/../../../../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    /**
     * Call artisan command and return code.
     *
     * @param string $command
     * @param array  $parameters
     *
     * @return int
     */
    public function artisan($command, $parameters = [])
    {
        if (is_null($this->app)) {
            return; // don't run when there is no application
        }

        return $this->code = $this->app['Illuminate\Contracts\Console\Kernel']->call($command, $parameters);
    }

    /**
     * Set a user in laravel.
     *
     * @param UserContract $user
     * @param string|null  $driver
     */
    public function be(UserContract $user, $driver = null)
    {
        $this->app['auth']->guard($driver)->setUser($user);
    }

    /**
     * Clears Laravel Cache.
     */
    protected function clearCache()
    {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];
        foreach ($commands as $command) {
            \Illuminate\Support\Facades\Artisan::call($command);
        }
    }
}
