<?php

namespace Modelizer\Selenium\Tests\Feature\Console;

use Modelizer\Selenium\Tests\TestCase;

class GetSeleniumServerTest extends TestCase
{
    /** @test */
    public function it_should_download_selenium_web_server()
    {
        $this->visit('/');
    }
}
