<?php

namespace Modelizer\Selenium\Tests\Feature;

use Modelizer\Selenium\SeleniumTestCase;

class FormTest extends SeleniumTestCase
{
    /** @test */
    function it_should_fill_input_fields()
    {
        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->type('Mohammed', 'firstName')
            ->type('Mudassir', 'lastName')
            ->typeById('hello@mudasir.me', 'inputEmail');
    }

    /** @test */
    function it_should_type_information()
    {
        $formInfo = [
            'firstName'  => 'Mohammed',
            'lastName'   => 'Mudassir',
            'inputEmail' => 'hello@mudasir.me',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->typeInformation($formInfo);
    }

    /** @test */
    function it_should_type_email_by_name()
    {
        $this->visit()
            ->click('Form')
            ->type('alice@foo.com', 'inputEmail-name');
    }

    /** @test */
    function it_should_type_email_by_id()
    {
        $this->visit()
            ->click('Form')
            ->typeById('bob@bar.com', 'inputEmail');
    }

    /** @test */
    function it_should_type_by_css_selector()
    {
        $this->visit()
            ->click('Form')
            ->select(1, '[name=dateDOB]')
            ->typeByCssSelector('bob@bar.com', '#inputEmail');
    }

    /** @test */
    function it_should_type_information_and_press_a_button()
    {
        $formInfo = [
            'firstName'  => 'Mohammed',
            'lastName'   => 'Mudassir',
            'inputEmail-name' => 'hello@mudasir.me',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->typeInformation($formInfo)
            ->press('Submit')
            ->see('Form successfully submitted');
    }

    /** @test */
    function it_should_submit_form()
    {
        $formInfo = [
            'firstName'  => 'Mohammed',
            'lastName'   => 'Mudassir',
            'inputEmail-name' => 'hello@mudasir.me',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->submitForm($formInfo, '#newAccount')
            ->see('Form successfully submitted');
    }
}
