<?php

namespace Modelizer\Selenium\Tests\Feature\Console;

use Modelizer\Selenium\SeleniumTestCase;

class GetSeleniumServerTest extends SeleniumTestCase
{
    /** @test */
    public function it_should_download_selenium_web_server()
    {
        $this->visit('/');
    }
}
