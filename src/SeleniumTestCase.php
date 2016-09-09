<?php

namespace Modelizer\Selenium;

use Modelizer\Selenium\Services\Application as Laravel;
use Modelizer\Selenium\Services\InteractsWithPage as Interactions;
use PHPUnit_Extensions_Selenium2TestCase;

class SeleniumTestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    use Laravel, Interactions;

    protected function setUp()
    {
        $this->setUpLaravel();

        $this->setBrowserUrl(env('APP_URL', 'http://localhost/'));
        $this->setBrowser(env('DEFAULT_BROWSER', 'chrome'));
    }

    /**
     * Force selenium to wait
     *
     * @param int|float $seconds The number of seconds or partial seconds to wait
     * @return $this
     */
    protected function hold($seconds=1)
    {
        usleep($seconds * 1000000);

        return $this;
    }

    protected function submitForm($inputs, $selector)
    {
        $form = $this->byCssSelector($selector);

        foreach ($inputs as $input => $value) {
            $form->byName($input)->value($value);
        }

        $form->submit();

        return $this;
    }
}
