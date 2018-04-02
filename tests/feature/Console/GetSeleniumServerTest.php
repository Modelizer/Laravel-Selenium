<?php

namespace Modelizer\Selenium\Tests\Feature\Console;

use Orchestra\Testbench\TestCase;

class GetSeleniumServerTest extends TestCase
{
    /** @test */
    public function it_should_download_selenium_web_server()
    {
        $this->artisan('selenium:web-driver:download');
    }
}
