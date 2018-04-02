<?php

namespace Modelizer\Selenium;

use Lmc\Steward\Test\AbstractTestCase;
use Modelizer\Selenium\Services\Application as Laravel;
use Modelizer\Selenium\Services\InteractWithPage as Interaction;
use Modelizer\Selenium\Services\ManageWindow;
use Modelizer\Selenium\Services\WaitForElement;
use Modelizer\Selenium\Services\WorkWithDatabase;

class SeleniumTestCase extends AbstractTestCase
{
    use Laravel,
        Interaction,
        WorkWithDatabase,
        WaitForElement,
        ManageWindow;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    public function setUp()
    {
        $this->setUpLaravel();
        $this->baseUrl = env('APP_URL', 'http://localhost/');
        $this->wd->get($this->baseUrl);

        $this->setBrowser(env('DEFAULT_BROWSER', 'chrome'));
    }

    public function setupPage()
    {
        if (empty($this->width)) {
            $this->width = env('SELENIUM_WIDTH', 1024);
        }

        if (empty($this->height)) {
            $this->height = env('SELENIUM_HEIGHT', 768);
        }

        $this->changeWindowSize($this->width, $this->height);
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
