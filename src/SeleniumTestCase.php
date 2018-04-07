<?php

namespace Modelizer\Selenium;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\Concerns\MocksApplicationServices;
use Lmc\Steward\Test\AbstractTestCase;
use Modelizer\Selenium\Services\InteractWithPage;
use Orchestra\Testbench\Concerns\Testing;
use Orchestra\Testbench\Contracts\TestCase as OrchestraTestCaseContract;

abstract class SeleniumTestCase extends AbstractTestCase implements OrchestraTestCaseContract
{
    use Testing,
        InteractsWithAuthentication,
        InteractsWithConsole,
        InteractsWithContainer,
        InteractsWithDatabase,
        InteractsWithExceptionHandling,
        InteractsWithSession,
        MakesHttpRequests,
        MocksApplicationServices,
        InteractWithPage;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setUpTheTestEnvironment();

        $this->baseUrl = env('APP_URL', $this->baseUrl);

        parent::setUp();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->tearDownTheTestEnvironment();
    }

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        return $this->setUpTheTestEnvironmentTraits();
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        $this->app = $this->createApplication();
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        putenv('APP_ENV=testing');
        $app->useEnvironmentPath($this->getRootDirectory());
        $app->loadEnvironmentFrom('testing.env');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
    }

    /**
     * Get root directory of a project or package
     * Note: $app->basePath() will not due to it is loading orchestra test package which is loading from
     * different directory and this application is been booted from steward.
     *
     * @return bool|string
     */
    private function getRootDirectory()
    {
        return realpath(__DIR__.($this->installedAsPackage() ? '/../../../../' : '/../'));
    }

    /**
     * Check if the selenium package is been installed as dependency or a separate project.
     *
     * @return bool
     */
    private function installedAsPackage()
    {
        return file_exists(__DIR__.'/../../../autoload.php');
    }
}
