<?php

namespace Modelizer\Selenium\Tests\Feature;

use Modelizer\Selenium\Tests\TestCase;

class FormTest extends TestCase
{
    /** @test */
    public function it_should_fill_input_fields()
    {
        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->type('John', 'firstName')
            ->type('Hoopes', 'lastName')
            ->typeById('john.hoopes@madisoncreativeweb.com', 'inputEmail');
    }

    /** @test */
    public function it_should_type_information()
    {
        $formInfo = [
            'firstName'  => 'John',
            'lastName'   => 'Hoopes',
            'inputEmail' => 'john.hoopes@madisoncreativeweb.com',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->typeInformation($formInfo);
    }

    /** @test */
    public function it_should_type_email_by_name()
    {
        $this->visit()
            ->click('Form')
            ->type('alice@foo.com', 'inputEmail-name');
    }

    /** @test */
    public function it_should_type_email_by_id()
    {
        $this->visit()
            ->click('Form')
            ->typeById('bob@bar.com', 'inputEmail');
    }

    /** @test */
    public function it_should_type_by_css_selector()
    {
        $this->visit()
            ->click('Form')
            ->select(1, '[name=dateDOB]')
            ->typeByCssSelector('bob@bar.com', '#inputEmail');
    }

    /** @test */
    public function it_should_type_information_and_press_a_button()
    {
        $formInfo = [
            'firstName'  => 'John',
            'lastName'   => 'Hoopes',
            'inputEmail-name' => 'john.hoopes@madisoncreativeweb.com',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->typeInformation($formInfo)
            ->press('Submit')
            ->see('Form successfully submitted');
    }

    /** @test */
    public function it_should_submit_form()
    {
        $formInfo = [
            'firstName'  => 'John',
            'lastName'   => 'Hoopes',
            'inputEmail-name' => 'john.hoopes@madisoncreativeweb.com',
        ];

        $this->visit()
            ->click('Form')
            ->see('Form Test')
            ->submitForm($formInfo, '#newAccount')
            ->see('Form successfully submitted');
    }
}
