<?php

namespace Modelizer\Selenium\Tests;

class InteractionTest extends TestCase
{
    /** @test */
    function it_should_visit_page()
    {
        $this->visit();
    }

    /** @test */
    function it_should_see_page_url()
    {
        $this->visit('/about')
            ->seePageIs('/about');
    }

    /** @test */
    function it_should_see_text_on_page()
    {
        $this->visit()
            ->see('Laravel Selenium Test Helper');
    }

    /** @test */
    function check_text_not_exists_on_page()
    {
        $this->visit()
            ->notSee('Bootstrap');
    }

    /** @test */
    function it_should_click_link()
    {
        $this->visit()
            ->click('Contact Us')
            ->see('Contact Us');
    }

    /** @test */
    function it_should_scroll()
    {
        $this->visit()
            ->click('About')
            ->see('About this project')
            ->scroll(500)
            ->see('Notes');
    }
}
