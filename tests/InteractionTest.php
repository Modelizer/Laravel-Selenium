<?php

namespace Modelizer\Selenium\Test;

class InteractionsTest extends TestCase {


    public function testVisitPages()
    {
        $this->visit('/tests/html/main.html');
    }

    public function testSeePageIs()
    {
        $this->visit('/tests/html/main.html')
            ->seePageIs('/tests/html/main.html');
    }

    public function testSee()
    {
        $this->visit('/tests/html/main.html')
            ->see('Laravel Selenium Test Helper');
    }

    public function testNotSee()
    {
        $this->visit('/tests/html/main.html');
        $this->notSee('Bootstrap');
    }
    
    public function testCanClickLinks()
    {
        $this->visit('/tests/html/main.html')
            ->click('Contact Us')
            ->see('Contact Us');
    }

    public function testCanScrollPage()
    {
        $this->visit('/tests/html/main.html')
            ->click('About')
            ->see('About this project')
            ->scroll(500)
            ->see('Notes');
    }


}