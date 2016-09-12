<?php

namespace Modelizer\Selenium;

use Modelizer\Selenium\Services\Application as Laravel;
use Modelizer\Selenium\Services\InteractWithPage as Interaction;
use Modelizer\Selenium\Services\WaitForElement;
use Modelizer\Selenium\Services\WorkWithDatabase;
use PHPUnit_Extensions_Selenium2TestCase;

class SeleniumTestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    use Laravel,
        Interaction,
        WorkWithDatabase,
        WaitForElement;

    /**
     * @var string
     */
    protected $baseUrl;

    protected function setUp()
    {
        $this->setUpLaravel();
        $this->baseUrl = env('APP_URL', 'http://localhost/');
        $this->setBrowserUrl($this->baseUrl);
        $this->setBrowser(env('DEFAULT_BROWSER', 'chrome'));
    }

    public function setupPage()
    {
        if (!empty(getenv('SELENIUM_WIDTH')) && !empty(getenv('SELENIUM_HEIGHT')) &&
            is_int(intval(getenv('SELENIUM_WIDTH'))) && is_int(intval(getenv('SELENIUM_HEIGHT')))) {
            $this->prepareSession()->currentWindow()->size([
                'width'  => intval(getenv('SELENIUM_WIDTH')),
                'height' => intval(getenv('SELENIUM_HEIGHT')),
            ]);
        }
    }

    /**
     * Force selenium to wait.
     *
     * @param int|float $seconds The number of seconds or partial seconds to wait
     *
     * @return $this
     */
    protected function wait($seconds = 1)
    {
        usleep($seconds * 1000000);

        return $this;
    }

    /**
     * Alias for wait.
     *
     * @param int $seconds
     *
     * @return SeleniumTestCase
     */
    public function hold($seconds = 1)
    {
        return $this->wait($seconds);
    }
}
