<?php

namespace Modelizer\Selenium\Tests\Feature;

use Modelizer\Selenium\SeleniumTestCase;

class InteractionTest extends SeleniumTestCase
{
    /** @test */
    public function it_should_visit_page()
    {
        $this->visit();
    }

    /** @test */
    public function it_should_see_page_url()
    {
        $this->visit('/about')
            ->seePageIs('/about');
    }

    /** @test */
    public function it_should_see_text_on_page()
    {
        $this->visit()
            ->see('Laravel Selenium Test Helper');
    }

    /** @test */
    public function check_text_not_exists_on_page()
    {
        $this->visit()
            ->notSee('Bootstrap');
    }

    /** @test */
    public function it_should_click_link()
    {
        $this->visit()
            ->click('Contact Us')
            ->see('Contact Us');
    }

    /** @test */
    public function it_should_scroll()
    {
        $this->visit()
            ->click('About')
            ->see('About this project')
            ->scroll(500)
            ->see('Notes');
    }
}
