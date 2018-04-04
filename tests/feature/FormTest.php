<?php

namespace Modelizer\Selenium\Tests\Feature;

use Modelizer\Selenium\Tests\TestCase;

class FormTest extends TestCase
{
    public function testItCanType()
    {
        $this->visit('about')
            ->click('Forms')
            ->see('Forms Test')
            ->type('John', 'firstName')
            ->type('Hoopes', 'lastName')
            ->type('john.hoopes@madisoncreativeweb.com', 'inputEmail');
    }
}
